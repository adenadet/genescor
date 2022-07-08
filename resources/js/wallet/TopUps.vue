<template>
<div class="card">
    <div class="modal fade" id="topUpModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <WalletFormTopUp :user="user"/>
                </div>
            </div>
        </div>
    </div>
    <div class="card-header">
        <h3 class="card-title">Top Ups</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-primary" title="New Topup" @click="addTopUp"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr><th>Date</th><th>Through</th><th>Amount</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="top_up in topups.data" :key="top_up.id">
                    <td>{{top_up.date}}</td>
                    <td>{{top_up.channel}}</td>
                    <td>{{top_up.amount | currency}}</td>
                    <td>{{top_up.status == 1 ? 'Completed' :(top_up.status == 0 ? 'Processing...' :' Rejected')}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <pagination :data="topups" @pagination-change-page="getTopUp">
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
            topups:{},
            user: {},
        }
    },
    methods:{
        addTopUp(){
            $('#topUpModal').modal('show');
        },
        getAllInitials(){
            this.$Progress.start();
            axios.get('/api/finance/topups')
            .then(response =>{
                this.topups = response.data.topups;
                this.user = response.data.user;
            })
            .catch(()=>{
                this.$Progress.fail();
                toast.fire({
                    icon: 'error',
                    title: 'topups not loaded successfully',
                })
            });
        },
        getTopUp(page=1){
            axios.get('/api/finance/topups?page='+page)
            .then(response=>{
                this.topups = response.data.topups;   
            });
        },
    },
    mounted() {
        this.getAllInitials();
        Fire.$on('searchInstance', ()=>{
            let query = this.$parent.search;
            axios.get('/api/ums/users/search?q='+query)
            .then((response ) => {})
            .catch(()=>{});
        });
        Fire.$on('userRoleReload', response =>{});
        Fire.$on('Reload', response =>{
            $('#userModal').modal('close'); 
            $('#roleModal').modal('close');    
        });
    },
}
</script>