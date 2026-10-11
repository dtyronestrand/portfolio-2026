<template>
    <form @submit.prevent="handleSubmit" class="flex max-w-180 min-w-0 flex-[1_1_300px] flex-col gap-6 py-4 px-2"
     >
        <h2>Resume Profile</h2>
        <section class="grid grid-cols-2 gap-6">
            <div>    
                <label for="first_name">First Name</label>
                <Input type="text" id="first_name" v-model="form.first_name" />
            </div>
            <div>
                <label for="last_name">Last Name</label>
                <Input type="text" id="last_name" v-model="form.last_name" />
            </div>
        </section>
        <section class="grid grid-cols-2 gap-6">
            <div class="col-span-2">
                <label for="street">Street</label>
                <Input type="text" id="street" v-model="form.address.street" />
            </div>
            <div>
                <label for="city">City</label>
                <Input type="text" id="city" v-model="form.address.city" />
            </div>
            <div>
                <label for="state">State</label>
                <Input type="text" id="state" v-model="form.address.state" />
            </div>
            <div>
                <label for="email">Email</label>
                <Input type="email" id="email" v-model="form.email" />
            </div>
            <div>
                <label for="phone">Phone</label>
                <Input type="text" id="phone" v-model="form.phone" />
            </div>
        </section>
        <section class="flex flex-col gap-4">
            <label for="summary">Summary</label>
            <Textarea id="summary" v-model="form.summary" rows="5"></Textarea>
        </section>
        <Button type="submit" :disabled="form.processing">Save</Button>
    </form>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { update } from '@/actions/App/Http/Controllers/ResumeController';
import {Button} from '@/components/ui/button'
import {Input} from '@/components/ui/input'
import {Textarea} from '@/components/ui/textarea'
interface Props {
    resume?: {
        first_name: string;
        last_name: string;
        email: string;
        phone: string;
        address: {
            street: string;
            city: string;
            state: string;
        };
        summary: string;
    };
}

const props = defineProps<Props>();

const form = useForm({
    first_name: props.resume?.first_name ?? '',
    last_name: props.resume?.last_name ?? '',
    email: props.resume?.email ?? '',
    phone: props.resume?.phone ?? '',
    address: {
        street: props.resume?.address?.street ?? '',
        city: props.resume?.address?.city ?? '',
        state: props.resume?.address?.state ?? '',
    },
    summary: props.resume?.summary ?? '',
});

const handleSubmit = () => {
    form.post(update.url(), {
        preserveScroll: true,
    });
};
</script>

<style scoped>

</style>