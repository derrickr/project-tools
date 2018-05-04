<?php

namespace App\Mail;

use App\Requests;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestStatusMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

     /**
     * The order instance.
     *
     * @var Request
     */
    public $request;
    public $action;
    public $kto;
    public $kcc='';
    public $ksubject;
    public $kview;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Requests $request,$action)
    {
        $this->request = $request;
        $this->action = $action;
        switch ($action) {
            case 'new':
                $this->newrequestMail();
                break;
            case 'fasttrack':
                $this->fasttrackMail();
                break;
            case 'cancel':
                $this->cancelMail();
                break;
            case 'update':
                $this->updateMail();
                break;
            case 'reject':
                $this->rejectMail();
                break;
            case 'more-info':
                $this->moreinfoMail();
                break;
            case 'accept':
                $this->acceptMail();
                break;
            case 'analysed':
                $this->analysedMail();
                break;
            case 'costed':
                $this->costedMail();
                break;
            case 'scheduled':
                $this->scheduledMail();
                break;
            case 'approved':
                $this->approvedMail();
                break;
            case 'implemented':
                $this->implementedMail();
                break;
            case 'rework':
                $this->reworkMail();
                break;
            case 'moretime':
                $this->moretimeMail();
                break;
            case 'backout':
                $this->backoutMail();
                break;
            case 'backedout':
                $this->backedoutMail();
                break;
            case 'pass':
                $this->passMail();
                break;
            case 'fail':
                $this->failMail();
                break;
            case 'reopen':
                $this->reopenMail();
                break;
            default:
                throw new \Exception('Mail action undefined.');
                break;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->kto) {
            $this->to($this->kto);
            if ($this->kcc)
                $this->cc($this->kcc);
            $this->subject($this->ksubject);
            $this->view($this->kview, ['request' => $this->request]);
            return $this;
        }
    }
    
    public function acceptMail(){
        $this->kto = $this->getEmails(["analyser","coster","scheduler","projectmanager"]);
        $this->kcc = $this->getEmails(["requester","assessor"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Accepted for Technical Analysis, Costing and Scheduling";
        $this->kview = 'emails.requests.accepted';
    }
    
    public function cancelMail() {
        $this->kto = $this->getEmails(["requester"]);
        $this->kcc = $this->getEmails(["assessor" ,"analyser" , "coster" , "scheduler" , "approver","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Cancelled";
        $this->kview = 'emails.requests.cancelled';
    }
    
    public function approvedMail() {
        $this->kto = $this->getEmails(["analyser" , "coster" , "scheduler"]);
        $this->kcc = $this->getEmails(["requester" , "assessor","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Approved for Implementation";
        $this->kview = 'emails.requests.approved';
    }
    
    public function analysedMail() {
        $this->kto = $this->getEmails(["coster" , "scheduler"]);
        $this->kcc = $this->getEmails(["requester" , "analyser","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Analysed";
        $this->kview = 'emails.requests.analysed';
    }
    
    public function backedoutMail() {
        $this->kto = $this->getEmails(["requester" , "assessor" , "analyser" , "coster" , "scheduler" , "approver" , "tester","projectmanager"]);
        $this->kcc = $this->getEmails(["implementer"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Backed Out";
        $this->kview = 'emails.requests.backedout';
    }
    
    public function backoutMail() {
        $this->kto = $this->getEmails(["requester" , "assessor" , "analyser" , "coster" , "scheduler" , "approver" , "tester","projectmanager"]);
        $this->kcc = $this->getEmails(["implementer"]);
        $this->ksubject = "It has been determined that it is necessary to Back Out WorkRequest #" . $this->request->req_no;
        $this->kview = 'emails.requests.backingout';
    }
    
    public function passMail() {
        $this->kto = $this->getEmails(["requester" , "assessor" , "analyser" , "coster" , "scheduler" , "approver" , "implementer" , "tester","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Completed";
        $this->kview = 'emails.requests.completed';
    }
    
    public function costedMail() {
        $this->kto = $this->getEmails(["scheduler"]);
        $this->kcc = $this->getEmails(["requester" , "analyser" , "coster","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Costed";
        $this->kview = 'emails.requests.costed';
    }
    
    public function failMail() {
        $this->kto = $this->getEmails(["implementer"]);
        $this->kcc = $this->getEmails(["requester" , "analyser" , "scheduler" , "tester","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " Failed Testing";
        $this->kview = 'emails.requests.failedtesting';
    }
    
    public function fasttrackMail() {
        $this->kto = $this->getEmails(["requester" , "assessor" , "analyser" , "coster" , "scheduler" , "approver" , "implementer" , "tester","projectmanager"]);
        $this->ksubject = "Please note that a New WorkRequest #" . $this->request->req_no . " has been Fast Tracked";
        $this->kview = 'emails.requests.fasttracked';
    }
    
    public function implementedMail() {
        $this->kto = $this->getEmails(["tester"]);
        $this->kcc = $this->getEmails(["requester" , "scheduler" , "implementer" , "tester","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has now been implemented and is ready for testing";
        $this->kview = 'emails.requests.implemented';
    }
    
    public function moreinfoMail() {
        $this->kto = $this->getEmails(["requester"]);
        $this->kcc = $this->getEmails(["assessor" , "analyser" , "coster" , "scheduler" , "approver","projectmanager"]);
        $this->ksubject = "More Information is requiured for WorkRequest #" . $this->request->req_no;
        $this->kview = 'emails.requests.moreinfo';
    }
    
    public function moretimeMail() {
        $this->kto = $this->getEmails(["assessor"]);
        $this->kcc = $this->getEmails(["requester" , "analyser" , "coster" , "scheduler" , "approver","implementer","projectmanager"]);
        $this->ksubject = "More Time has been requested for WorkRequest #" . $this->request->req_no;
        $this->kview = 'emails.requests.moretime';
    }
    
    public function newrequestMail() {
        $this->kto = $this->getEmails(["assessor"]);
        $this->kcc = $this->getEmails(["requester"]);
        $this->ksubject = "New WorkRequest #" . $this->request->req_no . " has been submitted";
        $this->kview = 'emails.requests.newworkrequest';
    }
    
    public function rejectMail() {
        $this->kto = $this->getEmails(["requester"]);
        $this->kcc = $this->getEmails(["assessor", "analyser", "coster", "scheduler", "approver","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Rejected";
        $this->kview = 'emails.requests.rejected';
    }
    
    public function reopenMail() {
        $this->kto = $this->getEmails(["assessor"]);
        $this->kcc = $this->getEmails(["requester", "analyser", "coster", "scheduler", "approver", "implementer", "tester","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Reopened";
        $this->kview = 'emails.requests.reopened';
    }
    
    public function reworkMail() {
        $this->kto = $this->getEmails(["assessor"]);
        $this->kcc = $this->getEmails(["requester", "analyser", "coster", "scheduler", "approver", "implementer", "tester","projectmanager"]);
        $this->ksubject = "It has been indicated that WorkRequest #" . $this->request->req_no . " requires reworking";
        $this->kview = 'emails.requests.reworking';
    }
    
    public function scheduledMail() {
        $this->kto = $this->getEmails(["approver"]);
        $this->kcc = $this->getEmails(["requester", "assessor", "analyser", "coster", "scheduler","projectmanager"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been Scheduled";
        $this->kview = 'emails.requests.scheduled';
    }
    
    public function updateMail() {
        $this->kto = $this->getEmails(["requester","assessor"]);
        $this->ksubject = "WorkRequest #" . $this->request->req_no . " has been updated";
        $this->kview = 'emails.requests.updated';
    }
    
    private function getEmails($roles = []) {
        $emails = [];
        if(in_array('requester', $roles)){
            $emails[] = $this->request->requester;
        }
        $users = \App\User::ofRole($roles)->get(['email']);
        
        if ($users->count()) {
            foreach ($users as $users) {
                $emails[] = $users->email;
            }
        }
        return $emails;
    }

}
