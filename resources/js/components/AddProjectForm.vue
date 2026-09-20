<template>
    <form @submit.prevent="handleSubmit">
        <h2>Add Project</h2>
        <section>
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" v-model="form.name">
            </div>
            <div>
                <label for="problem">Problem</label>
                <textarea id="problem" v-model="form.problem"></textarea>
            </div>
            <div>
                <label for="product">Product</label>
                <textarea id="product" v-model="form.product"></textarea>
            </div>
            <div>
                <label for="tags">Tags</label>
                <select id="tags" v-model="form.tags">
                    <option disabled value="">Select Tags</option>
                    <option v-for="tag in props.tags" :key="tag" :value="tag">
                        {{ tag }}
                    </option>
                </select>
            </div>
        </section>

    </form>
</template>

<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3';
interface Props {
    tags: string[]
}
const props = defineProps<Props>()
const form = useForm({
    name: '',
    problem: '',
    product: '',
    tags: [],
    media: null
})


function handleSubmit() {
    form.post('projects.store', {
        forceFormData: true,
        onSuccess: ()=>{
            router.get('admin.dashboard')
        }
    })
}
</script>

<style scoped>

</style>