<?php

class Contribution extends MY_Controller {

    public $userdetails;
    public $type;

    public function __construct() {
        parent::__construct();
        $this->load->model('Wallet_model');
        $this->load->model('Account_model');

        $this->load->model('Es_Group_model');
        $this->load->model('Es_Group_Invite');
        $this->load->model('Es_Group_Members');
        $this->load->model('Es_Group_Wallet');
        $this->load->model('Es_Member_Wallet');
        $this->load->model('BankDetail_model');
        
        $this->userdetails = $this->GetDetails();

        if ($this->userdetails['id'] > 0) {
            $this->data['balance'] = $this->Wallet_model->Balance($this->userdetails['id']);
        }

        $this->type = $this->userdetails['type'];
//        

        $this->data['uinfo'] = $this->userdetails;
    }

    public function index() {
//        get all the groups available and 
        if ($this->type == VENDOR) {
//            get the group for user
            $result = $this->Es_Group_model->get_user($this->userdetails['id']);
            if (is_array($result) && count($result) > 0) {
                $this->data['esgroups'] = $result;
            } else {
//                get all the group member belongs
                $mygroups = $this->Es_Group_Members->get_group_user($this->userdetails['id']);
                if (is_array($mygroups) && count($mygroups) > 0) {
                    $this->data['esgroups'] = $mygroups;
                } else {
                    $invitex = $this->Es_Group_Invite->get_invite_user($this->userdetails['id']);
                    
                    if (is_array($invitex) && count($invitex) > 0) {
                       
                        $this->data['esgroups'] = $invitex;
                    }
                }
            }

//            get group invitations
            $invite = $this->Es_Group_Invite->get_invite_user($this->userdetails['id']);
            
            if (is_array($invite) && count($invite) > 0) {
                $this->data['myinvite'] = $invite;
            }
        }

        $this->body = "esusu/es_contr_index";
        $this->ShowView($this->type);
    }

    public function MyContribution() {
        
    }

    public function VNewgroup() {
        $this->body = "esusu/newesgroup";
        $this->ShowView($this->type);
    }

    public function prcNewGroup() {
        if ($this->type == VENDOR) {
            if (isset($_POST)) {
                $amt = $this->input->post('grpamt');
                $name = $this->input->post('grpname');
                $freq = $this->input->post('grpfreq');
                $total = $this->input->post('grptotal');
                if (is_numeric($amt)) {
                    $grpid = $this->Es_Group_model->new_group($name, $amt, $total, $freq, $this->userdetails['id']);
                    if (is_numeric($grpid)) {
//                        add to group wallet
                        redirect("Contribution/GroupDetails/{$grpid}");
                    }
                }
            }
        }
    }

    public function InviteMember() {
        if ($this->type == VENDOR) {
            if (isset($_POST)) {
//               get the user detail
                $grpid = $this->input->post('grpid');
                $username = $this->input->post('username');
                $udet = $this->Account_model->CheckUsername($username);
                if (is_array($udet) && count($udet) > 0) {
//                    send the invite
                    $rep = $this->Es_Group_Invite->new_invite($grpid, $udet['us_id']);
                    if ($rep) {
                        $this->session->set_userdata('invite', 1);
                        redirect("Contribution/GroupDetails/{$grpid}");
                    }
                }
            }
        }
    }

    public function AcceptInvite() {
        if (isset($_POST)) {
            if ($this->type == VENDOR) {
                $grpid = $this->input->post('grpid');
                $reply = $this->input->post('rep');

                if ($reply == 0) {
//                    delete the invite
                    $repx = $this->Es_Group_Invite->delete_invite($this->userdetails['id'], $grpid);
                    if ($repx) {
                        $this->session->set_userdata('accp', 1);
                        redirect('Contribution/index');
                    }
                } else {
//                    add to group member
                    $res = $this->Es_Group_Members->new_member($grpid, $this->userdetails['id']);
//                    add to member wallet
                    $repx = $this->Es_Group_Invite->delete_invite($this->userdetails['id'], $grpid);
                    if ($repx) {
                        $this->session->set_userdata('accp', 1);
                        redirect("Contribution/ColPosition/{$grpid}");
                    }
                }
            }
        }
    }

    public function GroupDetails($grpid) {
//        get group details
        if ($grpid != NULL) {
            $group = $this->Es_Group_model->get_a_group($grpid);
            if (is_array($group) && count($group) > 0) {
                $this->data['grpdet'] = $group;

                if ($group['us_id'] == $this->userdetails['id']) {


                    $invites = $this->Es_Group_Invite->get_grp_invite($grpid);
                    if (is_array($invites)) {
                        if (count($invites) < $group['es_grp_total']) {
                            $this->data['caninvite'] = 1;
                        }
                        $this->data['allinvites'] = $invites;
                    }
                }
//                get the member of this group
                $members = $this->Es_Group_Members->get_members($grpid);
                if (is_array($members) && count($members) > 0) {
                    $this->data['members'] = $members;
                }

                if (array_key_exists('invite', $_SESSION)) {
                    $this->data['invite'] = "Invitation Sent";
                    $this->session->unset_userdata('invite');
                }
//                get all the invited
            }
        }
        $this->body = "esusu/es_grp_det";
        $this->ShowView($this->type);
    }

    public function ColPosition($grpid) {
//        get member positions
        $members = $this->Es_Group_Members->get_members($grpid);
        if (is_array($members) && count($members) > 0) {
            $this->data['members'] = $members;
        }
//        get grp details
        $group = $this->Es_Group_model->get_a_group($grpid);
        if (is_array($group) && count($group) > 0) {
            $this->data['grpdet'] = $group;
        }
        $this->body = "esusu/es_grp_position";
        $this->ShowView($this->type);
    }

    public function AddPosition() {
        if (isset($_POST)) {
            if ($this->type == VENDOR) {
                $position = $this->input->post('myposition');
                $grpid = $this->input->post('grpid');

                $addpost = $this->Es_Group_Members->AddPosition($grpid, $position, $this->userdetails['id']);
                redirect("Contribution/GroupDetails/{$grpid}");
            }
        }
    }
    
    public function Withdrawals() {
        
        $this->body = "esusu/es_withdrawals";
        $this->ShowView($this->type);
    }
    public function BankDetail() {
//        get the bank detail of the current member
        
        
        $bank = $this->BankDetail_model->get_bank($this->userdetails['id']);
        $this->data['newbank']=1;
        if(is_array($bank)){
            $this->data['bankdet']=$bank;
            $this->data['newbank']=2;
        }
        
        $this->body = "esusu/bankdetail";
        $this->ShowView($this->type);
    }

}
