<template>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Active Members: {{members.count}}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fas fa-comments"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body bg-dark">
        <ul class="contacts-list">
            <li v-for="member in members" :key="member.id">
                <a href="#">
                    <img class="contacts-list-img"  :src="member.user.image !== null ? '/img/profile/'+member.user.image : '/img/profile/default.png'">
                    <div class="contacts-list-info">
                        <span class="contacts-list-name">{{member.user.first_name+' '+member.user.last_name}} 
                            <small class="contacts-list-date float-right"></small>
                        </span>
                        <span class="contacts-list-msg">Since {{member.created_at | excelDate}}</span>
                    </div>
                </a>
            </li>    
        </ul>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return {}
    },
    methods:{
        updateItems(invoice_items){
            this.form.invoice_items = invoice_items.items;
            this.form.delivery = invoice_items.delivery;
            this.form.vat = invoice_items.vat;
            this.form.sub_total = invoice_items.sub_total;
            this.form.totals = parseFloat(invoice_items.sub_total) + parseFloat(invoice_items.delivery) + parseFloat(invoice_items.vat);
        },
    },
    mounted() {
        //Fire.$on
        Fire.$on('editContribution', contribution =>{
            this.editContribution(contribution);
        }); 
    },
    props:{
        'members': Array,
    },
}
</script>