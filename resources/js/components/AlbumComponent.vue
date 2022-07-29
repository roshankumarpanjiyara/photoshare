<template>
    <div>
        <form @submit.prevent="createAlbum" enctype="multipart/form-data" v-if="!success">
            <div class="form-group"> 
                
                <label for="">Name of Album</label>
                <input for="" type="text" name="name" v-model="name" class="form-control" maxlength="15">
                <span v-if="allerrors.name" :class="['danger']">
                    {{allerrors.name[0]}}
                </span>
            </div>
            <div class="form-group"> 
                <label for="">Description of Album</label>
                <textarea name="description" class="form-control" v-model="description" maxlength="200" id="" cols="30" rows="10">
                </textarea>
                <span v-if="allerrors.description" :class="['danger']">
                    {{allerrors.description[0]}}
                </span>
            </div>
            <div class="form-group"> 
                <label for="">Category of Album</label>
                <select name="category" class="form-control" v-model="category" id="">
                    <option value="none" selected disabled hidden> 
                        Select an Option 
                    </option>
                    <option v-for="(category,index) in categories" 
                    :key="index" :value="category.id">
                        {{category.name}}
                    </option>
                    <span v-if="allerrors.category" :class="['danger']">
                        {{allerrors.category[0]}}
                    </span>
                </select>
            </div>
            <div class="form-group"> 
                <label for="">Image of Album</label>
                <input type="file" name="image" class="form-control"
                v-on:change="onImageChange">
                <span v-if="allerrors.image" :class="['danger']">
                    {{allerrors.image[0]}}
                </span>
            </div>
            <div class="form-group"> 
                <button class="btn btn-secondary" type="submit">Create</button>
            </div>
        </form>
        <div v-if="success">
            <a :href="'/upload/images/'+albumId">Your Album is created. Please click the link to upload th images</a>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            name:'',
            description:'',
            category:'',
            image:'',
            categories:[],
            albumId:'',
            success:false,
            allerrors:[]
        }
    },
    created() {
        this.getCategories()
    },
    methods: {
        getCategories(){
            axios.get('/api/categories').then((response)=>{
                this.categories=response.data;
            }).catch((error)=>{
                alert('Unable to fetch categories')
            })
        },
        onImageChange(e){
            console.log(e)
            this.image = e.target.files[0];
        },
        createAlbum(){
            const config = {
                headers:{
                    "Content-Type":"multipart/form-data"
                }
            }
            let formData = new FormData();
            formData.append('image',this.image);
            formData.append('name',this.name);
            formData.append('description',this.description);
            formData.append('category_id',this.category);
            axios.post('/albums/store',formData,config).then((response)=>{
                this.image='',
                this.name='',
                this.description='',
                this.category='',
                this.albumId= response.data.id
                console.log(response.data.id)
                this.success=true
            }).catch((error)=>{
                console.log(error)
                this.allerrors = error.response.data.errors
            })
        }
    }
}
</script>
<style>
.danger{
    color: red;
}
</style>