<template>
<div class="card card-primary">
<form role="form">
    <div class="card-header"><h3 class="card-title">Top Up Your Account</h3></div>
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Amount</label>
            <input type="number" class="form-control" id="topUp_amount" name="topUp_amount" v-model="TopUpData.amount" placeholder="Enter Amount">
        </div>
        <!--
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                </div>
            </div>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        -->
    </div>
    <div class="card-footer">
        <button type="button" :class="TopUpData.amount == 0 ? 'btn btn-primary disabled' : 'btn btn-primary'" @click="asyncPay">Submit</button>
    </div>
</form>
</div>
</template>
<script>
export default {
    data(){
        return  {
            TopUpData: {
                tx_ref: this.generateReference(),
                amount: 0,
                currency: 'NGN',
                payment_options: 'card,ussd',
                redirect_url: '',
                meta: {
                    'consumer_id': '7898',
                    'consumer_mac': 'kjs9s8ss7dd'
                },
                customer: {
                    name: 'Demo Customer  Name',
                    email: 'customer@mail.com',
                    phone_number: '0818450***44'
                },
                customizations: {
                    title: 'Customization Title',
                    description: 'Customization Description',
                    logo: 'https://flutterwave.com/images/logo-colored.svg'
                },
                callback: this.makePaymentCallback,
                onclose: this.closedPaymentModal
            },
        }
    },
    mounted() {
        Fire.$on('BioDataFill', user =>{
            this.BioData.fill(user);
        });
        Fire.$on('AfterCreation', ()=>{
            //axios.get("api/profile").then(({ data }) => (this.BioData.fill(data)));
        });
    },
    methods:{
        asyncPay() {
            this.TopUpData.customer.name = this.user.first_name+' '+this.user.last_name;
            this.TopUpData.customer.email = this.user.email;
            this.TopUpData.customer.phone_number = this.user.phone;
            
            this.asyncPayWithFlutterwave(this.TopUpData)
            .then((response) => {console.log(response)})
            .catch(()=>{toast.fire({icon: 'error', title: 'Payments not loaded successfully',})});
        },
        makePaymentCallback(response) {
            console.log("Pay", response);
        },
        closedPaymentModal() {
            console.log('payment is closed');
        },
        generateReference(){
            let date = new Date()
            return date.getTime().toString();
        },
        createUser(){

        },
    },
    props:{
        user: Object,
    }
}
</script>