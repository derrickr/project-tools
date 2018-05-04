<?php

namespace App\Mail;

use App\Actions;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActionStatusMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

     /**
     * The order instance.
     *
     * @var Request
     */
    public $action;
    public $status;
    public $kto;
    public $kcc='';
    public $ksubject;
    public $kview;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Actions $action,$status)
    {
        $this->action = $action;
        $this->status = $status;
        switch ($status) {
            case 'new':
                $this->newActionMail();
                break;
            case 'update':
                $this->updateActionMail();
                break;
            case 'close':
                $this->closeActionMail();
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
            $this->view($this->kview, ['action' => $this->action]);
            return $this;
        }
    }
    
    public function newActionMail(){
        $this->kto = array_unique(array_merge([$this->action->owner], $this->getEmails(['projectmanager'])));
        $this->ksubject = "NEW Action: " . $this->action->description;
        $this->kview = 'emails.actions.opened';
    }
    
    public function updateActionMail() {
        $this->kto = array_unique(array_merge([$this->action->owner], $this->getEmails(['projectmanager'])));
        $this->ksubject = "UPDATE to Action: " . $this->action->description;
        $this->kview = 'emails.actions.updated';
    }
    
    public function closeActionMail() {
        $this->kto = array_unique(array_merge([$this->action->owner], $this->getEmails(['projectmanager'])));
        $this->ksubject = "Action: " . $this->action->description . " CLOSED";
        $this->kview = 'emails.actions.closed';
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
