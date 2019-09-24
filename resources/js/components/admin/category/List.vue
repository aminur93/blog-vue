<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Category List</li>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Category List</h3>
                                
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/category-new" style="color: #ffffff;">Add category</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            <select v-model="select" name="" id="" @change="deleteSelected">
                                                <option value="">Select</option>
                                                <option value="">Delete All</option>
                                            </select>
                                            <br><br>
                                            <input type="checkbox" @click="selectAll" v-model="all_select">
                                            <span v-if="all_select==false">Check All</span>
                                            <span v-else>Uncheck All</span>
                                        </th>
                                        <th>Sl</th>
                                        <th>Category Name</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(category,index) in getallCategory" :key="category.id">
                                        <td><input type="checkbox" v-model="categoryItem" :value="category.id"></td>
                                        <td>{{ index + 1}}</td>
                                        <td>{{ category.cat_name }}</td>
                                        <td>{{ category.created_at | timeformat}}</td>
                                        <td>
                                            <router-link :to="`/category-edit/${category.id}`" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></router-link>
                                            ||
                                            <a href="" @click.prevent="deleteCategory(category.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category Name</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
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
        name: "list",
        data(){
          return{
              categoryItem: [],
              select: '',
              all_select:false
          }
        },
        mounted()
        {
             this.$store.dispatch("allCategory");
        },
        
        computed: {
            getallCategory()
            {
                return this.$store.getters.getCategory;
            }
        },
    
        methods: {
            deleteCategory(id){
                //console.log(id);
                axios.get('/delete_category/'+id)
                    .then(()=>{
                        this.$store.dispatch("allCategory");
                        Toast.fire({
                            type: 'success',
                            title: 'Category Delete successfully'
                        })
                    })
                    .catch(()=>{
                    
                });
                
            },
    
            deleteSelected(){
                axios.delete('/deletecategory/'+this.categoryItem)
                    .then(()=>{
                        this.categoryItem = [];
                        this.$store.dispatch("allCategory");
                        Toast.fire({
                            type: 'success',
                            title: 'Category Delete successfully'
                        })
                })
            },
    
            selectAll(){
                if(this.all_select==false){
                    this.all_select = true
                    for(var category in this.getallCategory){
                        this.categoryItem.push(this.getallCategory[category].id)
                    }
                }else{
                    this.all_select = false
                    this.categoryItem = []
                }
            }
        }
    }
</script>

<style scoped>
</style>