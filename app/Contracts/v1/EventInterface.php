<?php
/**
 * Created by PhpStorm.
 * User: arslan
 * Date: 6/10/19
 * Time: 11:49 PM
 */

namespace App\Contracts\v1;


interface EventInterface
{
    public function createEvent($data);
    public function getEvent();
    public function bookEvent($data);
    public function incompleteTransaction();
    public function saveTransaction($data);
    public function archived();
    public function payedParticipant($data);
    public function searchEvent($data);
    public function deleteEvent($data);
    public function getStats();
    public function getHistory($data);
    public function showEvent($id);
    public function editEvent($id,$data);
    public function addPayment($data);
    public function activeEvent();
    public function activeArchive();
    public function saveComment($data);
    public function paidParticipantEvent();
    public function unSelectedParticipant();
    public function fileUpload($data);
    public function uploadLogo($data);
    public function setting();
    public function deleteIncompleteTransection($id);
    public function getunpaidParticipant();
    public function deleteParticipant($id);


}
