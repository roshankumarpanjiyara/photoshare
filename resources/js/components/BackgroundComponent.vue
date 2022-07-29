<template>
    <div class="container">
        <div class="row">
            <div class="card-body">
                <img :src="'/storage/'+bgImage" width="500" alt="">
                <br>
                <form action="" @submit.prevent="updatebgPic" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="image" class="form-control" v-on:change="onImageChange">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['userid'],
    data () {
        return{
            image:'',
            bgImage:''
        }
    },
    mounted () {
        this.getUserRecentBg()
    },
    methods: {
        onImageChange(e){
            console.log(e)
            this.image = e.target.files[0];
        },
        updatebgPic(){
            const config = {
                headers:{
                    "Content-Type":"multipart/form-data"
                }
            }
            let formData = new FormData();
            formData.append('image',this.image);
            axios.post('/bg-pic',formData,config).then((response)=>{
                this.image = '',
                this.getUserRecentBg()
            }).catch((error)=>{
                alert('Unable to update Background!');
            })
        },
        getUserRecentBg(){
            axios.get('/user/bg/'+this.userid).then((response)=>{
                this.bgImage = response.data.substr(7)
            }).catch((error)=>{
                alert('error')
            })
        }
    }
}
</script>
