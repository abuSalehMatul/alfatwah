<template>
    <div class="col-md-10 ad-search-div">
       <div class="col-md-4">
            <select class="form-control" @change="search()" v-model="selectType"> 
                <option value="id">By Id </option>
                <option value="title"> By Title </option>
                <option value="status"> By Status </option>
            </select>
       </div>
       <div class="col-md-8"> 
           <input type="text" v-model="key" @keyup="search()" class="form-control">
       </div>
       <search-questions v-if="show" :questions="results"></search-questions>
    </div>
</template>

<script>
    import client from '@/client'
    import SearchQuestions from "./SearchQuestions.vue"
    export default {
        name: "admin-search",
        components: {
            SearchQuestions
        },
        data() {
            return {
                selectType: 'id',
                key: "",
                results: "",
                show: false
            }
        },
        methods:{
            search(){
                client.get(window.location.origin+ "/admin/api/search?type="+this.selectType +"&key="+this.key)
                .then(response => {
                    this.results = response.data;
                    if(this.results.length > 0){
                        this.show = true;
                    }else{
                        this.show = false
                    }
                })
            }
        }
    }
</script>
<style scoped>
.ad-search-div{
    position: relative;
    right: 100%;
    top: 11px;
}
</style>

