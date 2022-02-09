<?php
/**
 * Created by PhpStorm.
 * User: sikandar
 * Date: 6/20/19
 * Time: 9:34 PM
 */

namespace App\Services\v1;

use App\Contracts\v1\EmailsInterface;
use App\EmailTemplates;
use Barryvdh\DomPDF\Facade as PDF;
use File;

class EmailsService implements EmailsInterface
{
    public function storeEmails($data)
    {
        $email = new EmailTemplates();
        $email->name = $data['title'];
        $email->slug = $data['title'];
        $email->subject = $data['subject'];
        $email->variables = $data['variables'];
        $email->message = $data['message'];
        $email->save();

        return $email ? $email : false;
    }

    public function getEmailTemplates()
    {
        return $pages = EmailTemplates::get();
        //return response()->json($pages ? $pages : false);
    }

    public function editEmail($id)
    {
        $email = EmailTemplates::where('publish', 1)
            ->where('id', $id)
            ->get();

        return $email;
    }

    public function updateEmailTemplate($dataToUpdate)
    {
        //dd($dataToUpdate['id']);
        $templateData = EmailTemplates::find($dataToUpdate['id']);
        ///dd($abc);
        $templateData->name = $dataToUpdate['title'];
        $templateData->subject = $dataToUpdate['subject'];
        $templateData->variables = $dataToUpdate['variables'];
        $templateData->message = $dataToUpdate['message'];

        $templateData->save();

        //dd($templateData);
        return $templateData;
    }

    public function generatePdf($data)
    {
        // TODO: Implement generatePdf() method.
        $destination_path = 'uploads/invoices';

        if (! File::exists($destination_path)) {
            File::makeDirectory($destination_path, 0777, true);
        }
        $str = str_random(8);

        view()->share('order', $data['data']);
        $pdf = PDF::loadView('pdf');

        $pdf->save($destination_path.'/'.$str.'_'.'-invoice.pdf');
        $fpdf = $destination_path.'/'.$str.'_'.'-invoice.pdf';

        return config('app.url').'/'.$destination_path.'/'.$str.'_'.'-invoice.pdf';
    }
}
