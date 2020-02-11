<?php

use Illuminate\Database\Seeder;

class EmailTemplates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\EmailTemplates::truncate();
        DB::table('email_templates')->insert([
            [
                'name'                  =>  'New Admin User',
                'slug'                  =>  'new-admin-user',
                'subject'               =>  'Your account created successfully' ,
                'message'               =>  '<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td bgcolor="#1fa8d7" height="128">&nbsp;</td>
                                                    <td bgcolor="#1fa8d7">
                                                        <div style="text-align: center;"><span style="font-size: 26px; color: #fff; font-family: tahoma, Helvetica, sans-serif;">Tours Booking</span></div>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                    <td bgcolor="#FFFFFF" style="text-align: center;"><span style="font-size: 26px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;"><br>&nbsp;Welcome [first_name] [last_name] &nbsp;</span><span style="font-size: 26px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;"><br></span>

                                                        <p style="font-family: tahoma;">&nbsp;Your account has been created successfully with Tours Booking.</p>

                                                        <p>&nbsp; Your credentials to login are below: <br>
                                                        Email: [email]&nbsp; <br>
                                                        Password: [password]</p>

                                                        <p style="font-family: tahoma;">
                                                            <br>
                                                        </p>

                                                        <p>
                                                            <br>
                                                        </p>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                    <td bgcolor="#1fa8d7">

                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="mcnFollowContent" style="min-width: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" height="88" style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #fff;" valign="top">

                                                                        <table border="0" cellpadding="0" cellspacing="0" style="margin-left: calc(3%); width: 97%;" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" style="text-align: left; color: #fff; font-size: 15px;" valign="top" width="69%">
                                                                                        <div style="text-align: center;">Copyright &copy; &nbsp;Tours Booking - All rights reserved.</div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        ',
                'variables'             =>  'first_name, last_name, email, password',
                'publish'               =>  1,
                'deleted_at'            =>  null,
                'created_at'            =>  \Carbon\Carbon::now(),
                'updated_at'            =>  null,
            ],
            [
                'name'                  =>  'Run Campaign',
                'slug'                  =>  'run-campaign',
                'subject'               =>  'RCC2 Events Campaign' ,
                'message'               =>  '<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td bgcolor="#1fa8d7" height="128">&nbsp;</td>
                                                    <td bgcolor="#1fa8d7">
                                                        <div style="text-align: center;"><span style="font-size: 26px; color: #fff; font-family: tahoma, Helvetica, sans-serif;">Tours Booking</span></div>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                    <td bgcolor="#FFFFFF" style="text-align: center;">

                                                        <span style="font-size: 26px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;">
                                                            [content]
                                                        </span>

                                                        <span style="font-size: 10px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;">

                                                               <a href="https://domainname/un-subscribe/[unsubscribe]" >Unsubscribe</a>
                                                        </span>

                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>

                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                    <td bgcolor="#1fa8d7">

                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="mcnFollowContent" style="min-width: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" height="88" style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #fff;" valign="top">

                                                                        <table border="0" cellpadding="0" cellspacing="0" style="margin-left: calc(3%); width: 97%;" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" style="text-align: left; color: #fff; font-size: 15px;" valign="top" width="69%">
                                                                                        <div style="text-align: center;">Copyright &copy; &nbsp;Tours Booking - All rights reserved.</div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        ',
                'variables'             =>  'content , unsubscribe',
                'publish'               =>  1,
                'deleted_at'            =>  null,
                'created_at'            =>  \Carbon\Carbon::now(),
                'updated_at'            =>  null,
            ],

            [
                'name'                  =>  'Payment Invoice',
                'slug'                  =>  'payment-invoice',
                'subject'               =>  'RCC2 Event Booking Invoice ' ,
                'message'               =>  '<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tbody>
                <tr>
                    <td bgcolor="#1fa8d7" height="128">&nbsp;</td>
                    <td bgcolor="#1fa8d7">
                        <div style="text-align: center;"><span
                                    style="font-size: 26px; color: #fff; font-family: tahoma, Helvetica, sans-serif;">Tours Booking</span>
                        </div>
                    </td>
                    <td bgcolor="#1fa8d7">&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#1fa8d7">&nbsp;</td>
                    <td bgcolor="#FFFFFF" style="text-align: left;">
                        <span style="font-size: 26px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;"><br></span>


                        <p style="font-family: tahoma;">&nbsp;
                            Hi: [first_name] &nbsp;&nbsp;[last_name], &nbsp;
                            you have paid £ [payed_amount] against your tour to "[tour_name]".
                        </p>
                        <br>
                        <p>Total amount of tour is: £ [total_payable]. </p> <br>
                        <p>Total remaining amount to pay against tour "[tour_name]" is £ [due_amount] </p> <br>
                        <p>Your booking reference is [booking_reference]</p><br>
                        <p>Event Description</p> <br>
                        <p>[event_description]</p>


                    <td bgcolor="#1fa8d7"><br></td>
                </tr>
                <tr>
                    <td bgcolor="#1fa8d7">&nbsp;</td>
                    <td bgcolor="#1fa8d7">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="mcnFollowContent"
                               style="min-width: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                               width="100%">
                            <tbody>
                            <tr>
                                <td align="center"
                                    style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                    valign="top">&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td align="center" height="88"
                                    style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #fff;"
                                    valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" style="margin-left: calc(3%); width: 97%;"
                                           width="100%">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="text-align: left; color: #fff; font-size: 15px;" valign="top"
                                                width="69%">
                                                <div style="text-align: center;">Copyright &copy; Tours Booking - All
                                                    rights reserved.
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td bgcolor="#1fa8d7">&nbsp;</td>
                </tr>
                </tbody>',
                'variables'             =>  'first_name , last_name, payed_amount,  tour_name, total_payable, due_amount, booking_reference, event_description',
                'publish'               =>  1,
                'deleted_at'            =>  null,
                'created_at'            =>  \Carbon\Carbon::now(),
                'updated_at'            =>  null,
            ],





            [
                'name'                  =>  'Partial Payments Cron Email',
                'slug'                  =>  'partial-payments-cron-email',
                'subject'               =>  'Event Booking Payment Reminder' ,
                'message'               =>  '<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                            <tr>
                                                <td bgcolor="#1fa8d7" height="128">&nbsp;</td>
                                                <td bgcolor="#1fa8d7">
                                                    <div style="text-align: center;"><span
                                                                style="font-size: 26px; color: #fff; font-family: tahoma, Helvetica, sans-serif;">Tours Booking</span>
                                                    </div>
                                                </td>
                                                <td bgcolor="#1fa8d7">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#1fa8d7">&nbsp;</td>
                                                <td bgcolor="#FFFFFF" style="text-align: left;">
                                                    <span style="font-size: 26px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;"><br></span>
                                                    <p style="font-family: tahoma;">&nbsp; Hi: [first_name] &nbsp;&nbsp;[last_name], &nbsp;you have paid £ [payed_amount] as partial payment against your tour to "[event_title]".</p><br>
                                                    <p>Total amount of tour is: £ [total_payable]. </p> <br>
                                                    <p>Total remaining amount to pay against tour "[event_title]" is £ [due_amount] </p>

                                                    <span style="font-size: 10px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;">
                                                         <a href="https://domainname/un-subscribe/[unique_number]" >Unsubscribe
                                                        </a>
                                                    <br>
                                                    </span>


                                                <td bgcolor="#1fa8d7">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#1fa8d7">&nbsp;</td>
                                                <td bgcolor="#1fa8d7">
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="mcnFollowContent"
                                                           style="min-width: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                                           width="100%">
                                                        <tbody>
                                                        <tr>
                                                            <td align="center"
                                                                style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                                                valign="top">&nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" height="88"
                                                                style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #fff;"
                                                                valign="top">
                                                                <table border="0" cellpadding="0" cellspacing="0" style="margin-left: calc(3%); width: 97%;"
                                                                       width="100%">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="center" style="text-align: left; color: #fff; font-size: 15px;" valign="top"
                                                                            width="69%">
                                                                            <div style="text-align: center;">Copyright &copy; Tours Booking. All
                                                                                rights reserved.
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td bgcolor="#1fa8d7">&nbsp;</td>
                                            </tr>
                                            </tbody>
                                        </table>',
                'variables'             =>  'first_name , last_name, payed_amount, event_title, total_payable, due_amount, unique_number',
                'publish'               =>  1,
                'deleted_at'            =>  null,
                'created_at'            =>  \Carbon\Carbon::now(),
                'updated_at'            =>  null,
            ],




        ]);
    }
}
