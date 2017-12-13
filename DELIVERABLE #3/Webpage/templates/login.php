<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-login">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <a href="#" id="login-form-link">Login</a>
                </div>
            </div>
            <hr>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="<?=$BASE_URL?>pages/actionLog.php" method="post" id="login-form" style="display: block;">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="<?=$form_values['email']?>" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
