<?php

/* @var $this yii\web\View */

$this->title = 'calculateMe';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">Wellcome to calculateMe, your account has been successfuly created.</p>

        <p><a class="btn btn-lg btn-success" href="/tag/create">Get started</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>1.Create Tags</h2>

                <p>With Tags you can classified the debts, demands and expenses</p>

                <p><a class="btn btn-default" href="/tag/create">Create a Tag Here &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>2.Create Contacts</h2>

                <p>With Contact you can calculate your debts and demands per person and manage the easily.</p>

                <p><a class="btn btn-default" href="/contact/create">Create a Contact Here &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>3.Now you are ready to go</h2>

                <p>now that you have tag and contact you can easily create, update, view your debts, demands, and expenses</p>

                <p><a class="btn btn-default" href="/expense/index">See Expenses here &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
