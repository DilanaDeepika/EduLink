<?php

class Account extends Model
{
    protected $table = 'accounts';
    
 
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6', 
        'role' => 'required',
      
    ];

    public function validate($data)
    {
        // Run all the generic rules from the base Model first
        parent::validate($data);

        // --- Add Custom Checks ---

        // Check for unique email
        if (empty($this->validation_errors['email'])) {
            if ($this->first(['email' => $data['email']])) {
                $this->validation_errors['email'] = 'This email address is already in use.';
            }
        }
        
        // Check for password confirmation (if your form has it)
        if (isset($data['password']) && isset($data['password_confirm'])) {
            if ($data['password'] !== $data['password_confirm']) {
                $this->validation_errors['password_confirm'] = 'The passwords do not match.';
            }
        }

        return empty($this->validation_errors);
    }
}