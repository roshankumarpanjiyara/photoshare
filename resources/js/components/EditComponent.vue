<template>
	<div>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Album</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">		        
                        <form  enctype="multipart/form-data" @submit.prevent="updateAlbum">
                            <div class="form-group">                   
                                <label>Name of Album</label>
                                <input type="text" name="name" class="form-control" maxlength="15" required="" v-model="editrecord.name">                    
                            </div>
                            <div class="form-group">
                                <label>Description of Album</label>
                                <textarea class="form-control"  maxlength="200" name="description" required="" v-model="editrecord.description"></textarea>   
                            </div>
                            <div class="form-group">
                                <label>Category of Album</label>
                                <select name="category" class="form-control" v-model="editrecord.category_id" id="">
                                    <option value="none" selected disabled hidden> 
                                        Select an Option 
                                    </option>
                                    <option v-for="(category,index) in categories" 
                                    :key="index" :value="category.id">
                                        {{category.name}}
                                    </option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image of Album</label>
                                <input type="file" name="image" class="form-control"
                                 v-on:change="onImageChange">  
                            </div>
                            <div class="form-group">
                                <button class="btn btn-secondary" type="submit">Update Album</button>
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
    props:['editrecord'],
    data(){
        return{
            categories:[],
            image:''
        }
    },
    created() {
        this.getCategories();
    },
    methods: {
        getCategories(){
            axios.get('/api/categories').then((response)=>{
                this.categories=response.data;
            }).catch((error)=>{
                alert('Unable to fetch categories')
            })
        },
        updateAlbum(){
            const config = {
                headers:{
                    "Content-Type":"multipart/form-data"
                }
            }
            let formData = new FormData();
            formData.append('image',this.image);
            formData.append('name',this.editrecord.name);
            formData.append('description',this.editrecord.description);
            formData.append('category_id',this.editrecord.category_id);
            formData.append("_method","put"); //this is for put route
            axios.post('/albums/'+this.editrecord.id+'/edit',formData,config).then((response)=>{
                $('#exampleModal').modal('hide');
                this.$emit('recordUpdated',response)
                // Swal.fire({
                // position: 'center',
                // icon: 'success',
                // title: 'Your work has been saved',
                // showConfirmButton: false,
                // timer: 1500
                // })
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                Toast.fire({
                icon: 'success',
                title: 'Updated successfully'
                })
            }).catch((error)=>{
                console.log(error)
            })
        },
        onImageChange(e){
            console.log(e)
            this.image = e.target.files[0];
        }
    }
}
</script>