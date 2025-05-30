<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends Controller
{
    public function dashboard(){
        $totalComments = Comment::count();
        $totalUsers = User::where('role', 'user')->count();
        $newComments = Comment::whereDate('created_at', '>=', Carbon::now()->subDays(7))->count();
        $totalClasses = Classes::count(); // Pastikan Model Classes benar dan tabelnya ada

        $lineChartLabels = [];
        $lineChartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $lineChartLabels[] = $date->format('d M');
            $lineChartData[] = Comment::whereDate('created_at', $date->format('Y-m-d'))->count();
        }

        $recentComments = Comment::latest()->take(5)->get();

        $monthlyCommentsData = Comment::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTHNAME(created_at) as month_name'),
                DB::raw('MONTH(created_at) as month_number'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupBy('year', 'month_name', 'month_number')
            ->orderBy('year', 'asc')
            ->orderBy('month_number', 'asc')
            ->get();

        $barChartMonthlyLabels = $monthlyCommentsData->map(function ($item) {
            return $item->month_name . ' ' . $item->year;
        });
        $barChartMonthlyData = $monthlyCommentsData->pluck('count');

        return view('admin.dashboard', compact(
            'totalComments', 'totalUsers', 'newComments', 'totalClasses',
            'lineChartLabels', 'lineChartData', 'recentComments',
            'barChartMonthlyLabels', 'barChartMonthlyData'
        ));
    }

    // METHOD UNTUK MENAMPILKAN HALAMAN MANAJEMEN KOMENTAR
    public function comments(Request $request) {
        $sortOrder = $request->query('sort', 'latest');
        $commentsQuery = Comment::query();

        if ($sortOrder === 'oldest') {
            $commentsQuery->orderBy('created_at', 'asc');
        } else { // Default atau jika sort=latest
            $commentsQuery->orderBy('created_at', 'desc');
        }

        $comments = $commentsQuery->get();

        return view('admin.comments.index', compact('comments', 'sortOrder'));
    }

    // Method untuk menampilkan detail komentar
    public function showComment(Comment $comment) {
         return view('admin.comments.show', compact('comment'));
    }

    public function destroyComment(Comment $comment) {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Komentar berhasil dihapus!');
    }

    public function updateComment(Request $request, Comment $comment) {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'kelas' => 'required|string|max:50',
            'komentar' => 'required|string',
        ]);
        $comment->update($validatedData);
        return redirect()->route('admin.comments.index')->with('success', 'Komentar berhasil diperbarui!');
    }

    // Method untuk manajemen pengguna
    public function users(){
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function showUser(User $user)  {

        return view('admin.users.show', compact('user'));
    }

    public function updateUser(Request $request, User $user) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,user',
        ]);
        $user->update($validatedData);
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroyUser(User $user)  {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    // Method untuk ekspor PDF Komentar
    public function exportCommentsPdf()
    {
        $comments = Comment::latest()->get();
        $data = [
            'title' => 'Laporan Data Komentar Siswa',
            'date' => date('d F Y'),
            'comments' => $comments
        ];
        $fileName = 'laporan-komentar-siswa-' . date('YmdHis') . '.pdf';
        $pdf = Pdf::loadView('admin.comments.pdf', $data);
        return $pdf->stream($fileName);
    }

    public function exportCommentsSpreadsheet()
    {
        $comments = Comment::latest()->get(); // Ambil data komentar

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Komentar Siswa'); // Nama sheet

        // Set Headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Kelas');
        $sheet->setCellValue('E1', 'Komentar');
        $sheet->setCellValue('F1', 'Dikirim Pada');

        // Style untuk Header (opsional, contoh sederhana)
        $headerStyleArray = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ];
        $sheet->getStyle('A1:F1')->applyFromArray($headerStyleArray);

        // Isi Data
        $rowNumber = 2; // Mulai dari baris ke-2 setelah header
        foreach ($comments as $comment) {
            $sheet->setCellValue('A' . $rowNumber, $comment->id);
            $sheet->setCellValue('B' . $rowNumber, $comment->nama);
            $sheet->setCellValue('C' . $rowNumber, $comment->email);
            $sheet->setCellValue('D' . $rowNumber, $comment->kelas);
            $sheet->setCellValue('E' . $rowNumber, $comment->komentar); // Komentar penuh
            $sheet->setCellValue('F' . $rowNumber, $comment->created_at->format('d M Y, H:i'));
            $rowNumber++;
        }

        // Auto-size columns (opsional, agar lebih rapi)
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Siapkan writer dan nama file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'laporan-komentar-siswa-' . date('YmdHis') . '.xlsx';

        // Header HTTP untuk memicu download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
