<template>  
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3><p>Account Balance</p>
            </div>
            <div class="icon"><i class="fa fa-wallet"></i></div>
            <router-link to="/patient/wallet" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Bounce Rate</p>
            </div>
            <div class="icon"><i class="ion ion-stats-bars"></i></div>
            <router-link href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner"><h3>44</h3><p>Pending Appointments</p></div>
            <div class="icon"><i class="fa fa-calendar"></i></div>
            <router-link to="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner"><h3>65</h3><p>Messages</p></div>
            <div class="icon"><i class="fa fa-envelope"></i></div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
</template>