<template>
 <div class="container">
    <div class="row justify-content-center mt-4">
   <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Payment</div>

                <div class="card-body">
                    <form @submit.prevent="addPayment">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">Phone</label>
                            <div class="col-md-6">
                                <input id="email" name="phone" type="text"  v-model="form.phone"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                                <has-error :form="form" field="phone"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">Amount</label>
                            <div class="col-md-6">
                                <input type="number" v-model="form.amount"  name="amount"
                                 class="form-control" :class="{ 'is-invalid': form.errors.has('amount') }">
                                  <has-error :form="form" field="amount"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary">
                                    Pay
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
</template>

<script>
   export default {
      data() {
         return {
            form :new Form(
            {
                id: '',
              phone: '',
              amount: ''
            }
          )
         }
      },
      methods: {
         addPayment() {
            axios.post('api/payment')
            .then(()=>{
                console.log('Payment Made');
            })
            .catch(()=>{
                console.log('Error Making Payment')
            })
         }
      }
   }
</script>
