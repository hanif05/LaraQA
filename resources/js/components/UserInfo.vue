<template>
    <div>
        <span class="text-muted">{{ postDate }}</span>
        <div class="media mt-2">
            <a :href="users.url" class="pr-2">
                <img :src="users.avatar" alt="" srcset="">
            </a>
            <div class="media-body mt-1">
                <a :href="users.url">{{ users.name }}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['model', 'label'],

    computed: {
        postDate() {
            return this.label + " " + this.model.created_date;
        },
    },
    data () {
        return {
            users: this.model.user,
        }
    },
}
</script>