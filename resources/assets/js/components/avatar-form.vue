<template>
    <div>
        <div class="level">
            <img :src="avatar" width="80" class="img-thumbnail mr-1">

            <h1 v-text="user.name"></h1>
        </div>

        <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
            <image-upload name="avatar" class="mr-1" @loaded="onLoad"></image-upload>
        </form>

    </div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue';

    export default {
        props: ['user'],

        components: { ImageUpload },

        data() {
            return {
                avatar: this.user.avatar
            };
        },
        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },
        mounted(){
            console.log(this.user)
        },
        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src;

                this.persist(avatar.file);
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`/api/users/${this.user.id}/avatar`, data)
                    .then(() => this.$toastr.s('Avatar uploaded!'));
            }
        }
    }
</script>

<style scoped>

</style>
