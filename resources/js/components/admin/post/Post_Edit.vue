<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Post</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Edit Post</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Post</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="EditNewPost()" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="title">Post Title</label>
                                                <input type="text" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }" id="title" placeholder="Enter Post Title" class="form-control">
                                                <has-error :form="form" field="title"></has-error>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="photo">Photo</label>
                                                <input @change="changePhoto($event)" type="file" name="photo" :class="{ 'is-invalid': form.errors.has('photo') }" id="photo" class="form-control">
                                                <has-error :form="form" field="photo"></has-error>
                                            </div>
                                        
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            
                                            <div class="form-group">
                                                <label for="cat_id">Category</label>
                                                <select v-model="form.cat_id" name="cat_id" id="cat_id" :class="{ 'is-invalid': form.errors.has('cat_id') }" class="form-control">
                                                    <option value="">~~Select~~</option>
                                                    <option v-for="cat in getallCategory" v-bind:value="cat.id">{{ cat.cat_name}}</option>
                                                </select>
                                                <has-error :form="form" field="category"></has-error>
                                            </div>
                                            
                                            <div class="form-group">
                                                <img :src="updateImage()" alt="" style="width: 100px">
                                            </div>
                                        
                                        </div>
                                    
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <markdown-editor v-model="form.description"></markdown-editor>
                                        <has-error :form="form" field="description"></has-error>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "post_-edit",
        data(){
            return{
                form: new Form({
                    title: '',
                    description: '',
                    cat_id: '',
                    photo: ''
                })
            }
        },
        mounted(){
            this.$store.dispatch("allCategory");
        },
        
        created(){
            axios.get(`post_edit/${this.$route.params.postid}`)
                .then((response)=>{
                    this.form.fill(response.data.post)
                })
        },
    
        computed: {
            getallCategory()
            {
                return this.$store.getters.getCategory;
            }
        },
    
        methods: {
            changePhoto(event)
            {
                let file = event.target.files[0];
                if (file.size > 1048576){
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                }else {
                    let reader = new FileReader();
                    reader.onload = event => {
                    
                        this.form.photo =  event.target.result;
                    };
                
                    reader.readAsDataURL(file);
                }
            
            },
        
            EditNewPost(){
                //console.log(this.form.data());
                this.form.post(`/post_update/${this.$route.params.postid}`)
                    .then((response)=>{
                        this.$router.push('/post-list');
                        Toast.fire({
                            type: 'success',
                            title: 'Post Update successfully'
                        })
                    })
                    .catch(()=>{
                    })
            },
    
            updateImage(){
                let img = this.form.photo;
                if (img.length > 100){
                    return this.form.photo;
                }else {
                    return `uploads/${this.form.photo}`
                }
            }
        }
    }
</script>

<style scoped>

</style>