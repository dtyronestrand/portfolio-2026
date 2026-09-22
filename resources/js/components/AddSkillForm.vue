<template>
    <Form #default="{processing, wasSuccessful}" @finish="handleFinish" :action="store()" resetOnSuccess class="flex-[1 1 300px] min-w-0 max-w-[360px] p-[24px] border border(--border-card) rounded-[8px] bg-(--surface-container-low) flex flex-col gap-[20px]">
        <div class="flex flex-col gap-[4px]">
            <span class="text(--label-sm) text-xs">New Skill</span>
          
            <h2 class="text(--headline-md) m-0 text-xl leading-[26px]">Add New Skill</h2>
        </div>
        <Label for="skillName">Skill Name</Label>
        <Input v-model="newSkill.name" name="name" label="Skill Name" placeholder="Enter skill name" />
        <Label for="category">Category</Label>
        <Select name="skill_category_id" v-model="newSkill.categoryId">
            <SelectTrigger>
                <SelectValue placeholder="Select a category"/>
            </SelectTrigger>
            <SelectContent>

                <SelectGroup>
                    <SelectLabel>Categories</SelectLabel>
                    <SelectItem v-for="(category, index) in props.categories" :key="index" :value="category.id">
                        {{ category }}
                    </SelectItem>
                </SelectGroup>
            </SelectContent>
        </Select>
        <div class="flex flex-col gap-[10px]">
           
            <Label for="level">Level</Label>

            <Select name="level" v-model="newSkill.level">
                <SelectTrigger>

                    <SelectValue placeholder="Select Level" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectLabel>Level</SelectLabel>
                        <SelectItem value="1">Beginner</SelectItem>
                        <SelectItem value="2">Intermediate</SelectItem>
                        <SelectItem value="3">Advanced</SelectItem>
                        <SelectItem value="4">Expert</SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>
        <div class="flex flex-row gap-[8px] w-full min-w-0">

            <Button size="sm" type="button" @click="handleCancel" class="flex-1 min-w-0" variant="destructive">Cancel</Button>
            <Button size="sm" type="submit" :disabled="processing" class="flex-1 min-w-0">{{processing ? 'Adding...' : 'Add Skill'}}</Button>
        </div>
     <div v-if="wasSuccessful">Skill added successfully!</div>
    </Form>

    
</template>

<script setup lang="ts">
import {Form} from '@inertiajs/vue3';
import { ref } from 'vue';
import { store } from "@/actions/App/Http/Controllers/SkillController";
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import {Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue, } from '@/components/ui/select/';
import Button from './ui/button/Button.vue';
interface Props {
    categories: {
        id: number;
        name: string;
    }[];
}
const props = defineProps<Props>();
const newSkill = ref({
    name: '',
    categoryId: null,
    level: null,
});
const emit = defineEmits(['skillAdded', 'cancel']);

const handleFinish = () => {
    emit('skillAdded');
};

const handleCancel = () => {
    emit('cancel');
};
</script>

<style scoped>

</style>