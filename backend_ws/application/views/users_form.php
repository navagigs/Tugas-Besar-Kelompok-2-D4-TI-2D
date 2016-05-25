<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>USERS</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Id <?php echo form_error('id') ?></td>
            <td><input type="text" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $id; ?>" />
        </td>
	    <tr><td>Ip Address <?php echo form_error('ip_address') ?></td>
            <td><input type="text" class="form-control" name="ip_address" id="ip_address" placeholder="Ip Address" value="<?php echo $ip_address; ?>" />
        </td>
	    <tr><td>Username <?php echo form_error('username') ?></td>
            <td><input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </td>
	    <tr><td>Password <?php echo form_error('password') ?></td>
            <td><input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </td>
	    <tr><td>Salt <?php echo form_error('salt') ?></td>
            <td><input type="text" class="form-control" name="salt" id="salt" placeholder="Salt" value="<?php echo $salt; ?>" />
        </td>
	    <tr><td>Email <?php echo form_error('email') ?></td>
            <td><input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </td>
	    <tr><td>Activation Code <?php echo form_error('activation_code') ?></td>
            <td><input type="text" class="form-control" name="activation_code" id="activation_code" placeholder="Activation Code" value="<?php echo $activation_code; ?>" />
        </td>
	    <tr><td>Forgotten Password Code <?php echo form_error('forgotten_password_code') ?></td>
            <td><input type="text" class="form-control" name="forgotten_password_code" id="forgotten_password_code" placeholder="Forgotten Password Code" value="<?php echo $forgotten_password_code; ?>" />
        </td>
	    <tr><td>Forgotten Password Time <?php echo form_error('forgotten_password_time') ?></td>
            <td><input type="text" class="form-control" name="forgotten_password_time" id="forgotten_password_time" placeholder="Forgotten Password Time" value="<?php echo $forgotten_password_time; ?>" />
        </td>
	    <tr><td>Remember Code <?php echo form_error('remember_code') ?></td>
            <td><input type="text" class="form-control" name="remember_code" id="remember_code" placeholder="Remember Code" value="<?php echo $remember_code; ?>" />
        </td>
	    <tr><td>Created On <?php echo form_error('created_on') ?></td>
            <td><input type="text" class="form-control" name="created_on" id="created_on" placeholder="Created On" value="<?php echo $created_on; ?>" />
        </td>
	    <tr><td>Last Login <?php echo form_error('last_login') ?></td>
            <td><input type="text" class="form-control" name="last_login" id="last_login" placeholder="Last Login" value="<?php echo $last_login; ?>" />
        </td>
	    <tr><td>Active <?php echo form_error('active') ?></td>
            <td><input type="text" class="form-control" name="active" id="active" placeholder="Active" value="<?php echo $active; ?>" />
        </td>
	    <tr><td>First Name <?php echo form_error('first_name') ?></td>
            <td><input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $first_name; ?>" />
        </td>
	    <tr><td>Last Name <?php echo form_error('last_name') ?></td>
            <td><input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>" />
        </td>
	    <tr><td>Company <?php echo form_error('company') ?></td>
            <td><input type="text" class="form-control" name="company" id="company" placeholder="Company" value="<?php echo $company; ?>" />
        </td>
	    <tr><td>Phone <?php echo form_error('phone') ?></td>
            <td><input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>" />
        </td>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->