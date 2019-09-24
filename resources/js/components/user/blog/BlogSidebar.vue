<template>
    <span id="sidebar">
        <div class="span4">
            <aside class="right-sidebar">
                <div class="widget">
                    <form class="form-search">
                        <input @keyup="RealSearch" placeholder="Type something" v-model="keyword" type="text" class="input-medium search-query">
                        <button type="submit" @click.prevent="RealSearch" class="btn btn-square">Search</button>
                    </form>
                </div>
                
                <div class="widget">
                    <h5 class="widgetheading">Categories</h5>
                    <ul class="cat">
                        <li v-for="cat in getCategories"><i class="icon-angle-right"></i><router-link :to="`/categoryblog/${cat.id}`">{{ cat.cat_name}}</router-link><span> (20)</span></li>
                        
                    </ul>
                </div>
                
                <div class="widget">
                    <h5 class="widgetheading">Latest posts</h5>
                    <ul class="recent">
                        <li v-for="(post,index) in blogPost" v-if="index<3" :key="post.id">
                            <img :src="`uploads/${post.photo}`" class="pull-left" alt="" style="width: 50px;"/>
                            <h6><router-link :to="`/singleblog/${post.id}`">{{ post.title }}</router-link></h6>
                            <p>
                               {{ post.description | shortlength(35,'...')}}
                            </p>
                        </li>
                    </ul>
                </div>
                
            </aside>
        </div>
    </span>
</template>

<script>
    import _ from 'lodash';
    export default {
        name: "blog-sidebar",
        data(){
          return{
              keyword: ''
          }
        },
        mounted(){
            this.$store.dispatch("allLatestPost");
            this.$store.dispatch('allCategoryUser');
        },
        computed: {
            getCategories(){
                return this.$store.getters.getUserCategory;
            },
            blogPost(){
                return this.$store.getters.getlatestpost;
            }
        },
        methods: {
            RealSearch:_.debounce(function () {
                this.$store.dispatch('searchPost',this.keyword);
            },1000)
        },
        
    }
</script>

<style scoped>

</style>