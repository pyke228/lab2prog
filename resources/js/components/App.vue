<template>
    <div v-if="article" class="alert alert-primary alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <strong>Новая статья!</strong> 
        <a :href="`/articles/${article.id}`" class="alert-link">{{ article.title }}</a>
        <button type="button" class="btn-close" @click="article = null"></button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            article: null
        }
    },
    mounted() {
        console.log('Vue component mounted');
        
        window.Echo.channel('test')
            .listen('NewArticleEvent', (data) => {
                console.log('Pusher event received:', data);
                this.article = data.article;
                
                setTimeout(() => {
                    this.article = null;
                }, 8000);
            })
            .error((error) => {
                console.error('Pusher error:', error);
            });
    }
}
</script>