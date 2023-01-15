<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AgentStatus extends Component
{
    // public $agent;
    public $agent;
    public $agentStatus;

    public function render()
    {
        return view('livewire.agent-status');
    }

    public function mount(User $agent)
    {
        $this->agent = $agent;
        $this->agentStatus = $this->agent->status;
    }

    public function change()
    {
        $user = User::find($this->agent->id);
        if ($user->status == "")
            $user->status = 'on';
        else
            $user->status = '';
        $user->save();
    }
}