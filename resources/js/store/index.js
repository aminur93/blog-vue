export default {
    state: {
        category: [],
        post: [],
        blogpost: [],
        singlepost: [],
        usercategory: [],
        latestpost: []
    },
    getters: {
        getCategory(state){
            return state.category;
        },
        
        getPost(state){
            return state.post;
        },
        
        getBlogPost(state){
            return state.blogpost;
        },
        
        getSinglePost(state)
        {
            return state.singlepost;
        },
        
        getUserCategory(state){
            return state.usercategory;
        },
        getlatestpost(state){
            return state.latestpost;
        }
    },
    actions: {
        allCategory(context){
            axios.get('/category_list')
                .then((response)=>{
                    //console.log(response.data.categories);
                    context.commit('categories',response.data.categories);
                });
        },
    
        allPost(context)
        {
            axios.get('/post_list')
                .then((response)=>{
                    context.commit('allposts',response.data.posts);
                });
        },
        
        allBlogPost(context)
        {
            axios.get('/blog_post')
                .then((response)=>{
                    context.commit('allBlogPosts',response.data.blogposts);
                });
        },
    
        allSingleBlog(context,payload)
        {
            axios.get('/single_blog/'+payload)
                .then((response)=>{
                    context.commit('allsinglepost',response.data.singleblogpost);
                });
        },
        allCategoryUser(context){
            axios.get('/blog_category')
                .then((response)=>{
                    context.commit('allusercategory',response.data.usercategories);
                });
        },
    
        getPostByCatId(context,payload){
            axios.get('/post_by_catid/'+payload)
                .then((response)=>{
                    //console.log(response.data.post_cat);
                    context.commit('allPostByCatId',response.data.blogposts);
                });
        },
    
        searchPost(context,payload){
            axios.get('/search_post?v='+payload)
                .then((response)=>{
                    context.commit('searchByPost',response.data.blogposts);
                });
        },
    
        allLatestPost(context){
            axios.get('/latest_post')
                .then((response)=>{
                    context.commit('allBlogLatestPost',response.data.latestpost);
                });
        }
    },
    mutations: {
        categories(state,data){
            return state.category = data;
        },
        
        allposts(state,payload){
            return state.post = payload;
        },
        
        allBlogPosts(state,payload){
            return state.blogpost = payload;
        },
    
        allsinglepost(state,data){
            return state.singlepost = data;
        },
    
        allusercategory(state,data){
            return state.usercategory = data;
        },
    
        allPostByCatId(state,data){
            return state.blogpost = data;
        },
    
        searchByPost(state,data){
            return state.blogpost = data;
        },
        allBlogLatestPost(state,payload){
            return state.latestpost = payload;
        }
    }
}