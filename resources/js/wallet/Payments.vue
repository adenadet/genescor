<template>
<div class="card">
    <div class="card-header"><h3 class="card-title">Payments</h3></div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>For</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="payment in payments.data" :key="payment.id">
                    <td>{{payment.date}}</td>
                    <td>{{payment.item_name}}</td>
                    <td>{{payment.item_total}}</td>
                    <td>{{payment.status == 1 ? 'Completed' :(payment.status == 0 ? 'Processing...' :' Rejected')}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <pagination :data="payments" @pagination-change-page="getPayment">
            <span slot="prev-nav">&lt; Previous </span>
            <span slot="next-nav">Next &gt;</span>
        </pagination>
    </div>
</div>    
</template>
<script>
export default {
    data(){
        return {
            payments:{},
        }
    },
    methods:{
        getAllInitials(){
            this.$Progress.start();
            axios.get('/api/finance/payments')
            .then(response =>{
                this.payments = response.data.payments;
            })
            .catch(()=>{
                this.$Progress.fail();
                toast.fire({
                    icon: 'error',
                    title: 'Payments not loaded successfully',
                })
            });
        },
        getPayment(page=1){
            axios.get('/api/finance/payments?page='+page)
            .then(response=>{
                this.payments = response.data.payments;   
            });
        },
    },
    mounted() {
        this.getAllInitials();
        Fire.$on('searchInstance', ()=>{
            let query = this.$parent.search;
            axios.get('/api/ums/users/search?q='+query)
            .then((response ) => {this.users = response.data.users;})
            .catch(()=>{});
        });
        Fire.$on('userRoleReload', response =>{});
        Fire.$on('Reload', response =>{
            $('#userModal').modal('hide'); 
            $('#roleModal').modal('hide');
            this.users = response.data.users;
        });
    },
}
</script>
