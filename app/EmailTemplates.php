<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
    protected $table = 'email_templates';

    static function replaceEmailVariables($template, $email_patterns = null)
    {
        $mail_template = EmailTemplates::where('slug',$template)->first();
        if($mail_template){
            $subject = $mail_template->subject;
            $content = $mail_template->message;
            foreach ($email_patterns as $key => $value) {

                $subject = str_replace('['.$key.']', $value, $subject);
                $content = str_replace('['.$key.']', $value, $content);

            }
            return array(
                'subject' => $subject,
                'content' => $content,
            );
        }
    }
}
