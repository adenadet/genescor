import Vue from 'vue';
import VueRouter from 'vue-router';


import AppointmentAdmin     from './appointment/Admin.vue';
import AppointmentAll       from './appointment/All.vue';
import AppointmentList      from './appointment/List.vue';
import AppointmentView      from './appointment/View.vue';

    import AppointmentFormRequest from './appointment/forms/Request.vue';

Vue.component('AppointmentAdmin',   AppointmentAdmin);
Vue.component('AppointmentAll',     AppointmentAll);
Vue.component('AppointmentList',    AppointmentList);
Vue.component('AppointmentView',    AppointmentView);
    Vue.component('AppointmentFormRequest', AppointmentFormRequest);


import ChatRoom         from './chats/Room.vue';
import ChatMembers      from './chats/Members.vue';
import ChatMessage      from './chats/Message.vue';
import ChatLog          from './chats/Log.vue';
import ChatList         from './chats/List.vue';

    import ChatFormNew  from './chats/forms/New.vue';
    import ChatFormRoom from './chats/forms/Room.vue';

Vue.component('ChatList', ChatList);
Vue.component('ChatLog', ChatLog);
Vue.component('ChatMembers', ChatMembers);
Vue.component('ChatMessage', ChatMessage);
Vue.component('ChatRoom', ChatRoom);

    Vue.component('ChatFormNew', ChatFormNew);
    Vue.component('ChatFormRoom', ChatFormRoom);

import DashboardAdmin from './dashboard/Admin.vue';
import DashboardDoctor from './dashboard/Doctor.vue';
import DashboardHospital from './dashboard/Hospital.vue';
import DashboardPatient from './dashboard/Patient.vue';

Vue.component('DashboardAdmin',     DashboardAdmin);
Vue.component('DashboardDoctor',    DashboardDoctor);
Vue.component('DashboardPatient',   DashboardPatient);
Vue.component('DashboardHospital',  DashboardHospital);

import ProfileAdmin from './profile/Admin.vue';
import ProfileDoctor from './profile/Doctor.vue';
import ProfileHospital from './profile/Hospital.vue';
import ProfilePatient from './profile/Patient.vue';
    import ProfileFormBioData   from './profile/forms/BioData.vue';
    import ProfileFormDoctor    from './profile/forms/Doctor.vue';
    import ProfileFormNOK       from './profile/forms/NextOfKin.vue';
    import ProfileFormPassword  from './profile/forms/Password.vue';

Vue.component('ProfilePatient', ProfilePatient); 
    Vue.component('ProfileFormBioData', ProfileFormBioData); 
    Vue.component('ProfileFormDoctor', ProfileFormDoctor); 
    Vue.component('ProfileFormNOK', ProfileFormNOK); 
    Vue.component('ProfileFormPassword', ProfileFormPassword); 

import TCMessageLog from './teleconference/MessageLog.vue';
import TCVideoChat from './teleconference/VideoChat.vue';
import TCVideoConference from './teleconference/VideoConference.vue';

Vue.component('TCMessageLog',       TCMessageLog);
Vue.component('TCVideoChat',        TCVideoChat);
Vue.component('TCVideoConference',  TCVideoConference);

import AllRoles from './users/AllRoles.vue';    
import AllUsers from './users/AllUsers.vue';    

import UserFormAssignRole   from './users/forms/AssignRole.vue';    
import UserFormNOK          from './users/forms/NextOfKin.vue'; 
import UserFormRole         from './users/forms/Role.vue';    
import UserFormUser         from './users/forms/BioData.vue'; 
import UserRegistration     from './users/Registration.vue';

Vue.component('AllRoles',           AllRoles);
Vue.component('AllUsers',           AllUsers);
Vue.component('UserFormAssignRole', UserFormAssignRole);
Vue.component('UserFormNOK',        UserFormNOK);
Vue.component('UserFormRole',       UserFormRole);
Vue.component('UserFormUser',       UserFormUser);
Vue.component('UserRegistration',   UserRegistration);

import WalletMain from './wallet/Main.vue';
import WalletMini from './wallet/Mini.vue';
import WalletPayments from './wallet/Payments.vue';
import WalletTopUps from './wallet/TopUps.vue';
    
    import WalletFormTopUp from './wallet/forms/TopUp.vue';

Vue.component('WalletMain', WalletMain);
Vue.component('WalletMini', WalletMini);   
Vue.component('WalletPayments', WalletPayments); 
Vue.component('WalletTopUps', WalletTopUps);

    Vue.component('WalletFormTopUp', WalletFormTopUp);

let routes = [

    //General Patint Routes 
    {path: '/app/dashboard',                component: DashboardPatient},
    //Appointment Routes
    {path: '/app/appointments',             component: AppointmentAll},
    {path: '/app/appointments/:id',         component: AppointmentView},
    {path: '/app/admin/appointments',       component: AppointmentAdmin},
    {path: '/app/admin/appointments/:id',   component: AppointmentView},
    
    //Dashboard Routes
    {path: '/app/admin',                component: DashboardAdmin},
    {path: '/app/admin/dashboard',      component: DashboardAdmin},
    {path: '/app/admin/registrations',  component: UserRegistration},
    {path: '/app/admin/users',          component: AllUsers},
    {path: '/app/doctor',               component: DashboardDoctor},
    {path: '/app/doctor/dashboard',     component: DashboardDoctor},
    {path: '/app/hospital',             component: DashboardHospital},
    {path: '/app/hospital/dashboard',   component: DashboardHospital},
    {path: '/app/patient',              component: DashboardPatient},
    {path: '/app/patient/dashboard',    component: DashboardPatient},

    //Default Home Route 
    {path: '/home', component: TCVideoConference},

    //Chat Rooms Routes
    {path: '/app/chats', component:ChatList},
    {path: '/app/chats/:id', component:ChatRoom},

    //Profile Routes
    {path: '/app/admin/profile',        component: ProfileAdmin},
    //{path: '/app/doctor/profile', component: ProfileDoctor},
    //{path: '/app/hospital/profile', component: ProfileHospital},
    {path: '/app/profile', component: ProfilePatient},
    
    //Wallet Routes
    {path: '/app/wallet',           component: WalletMain},

    //User Management Routes
    {path: '/app/admin/users', component: AllUsers},
    

    //Teleconferencing Routes
    ]
    
const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
