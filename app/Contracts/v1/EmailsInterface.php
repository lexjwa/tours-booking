<?php
/**
 * Created by PhpStorm.
 * User: sikandar
 * Date: 6/20/19
 * Time: 9:35 PM
 */

namespace App\Contracts\v1;

interface EmailsInterface
{
    public function storeEmails($data);

    public function getEmailTemplates();

    public function editEmail($id);

    public function updateEmailTemplate($dataToUpdate);

    public function generatePdf($data);
}
