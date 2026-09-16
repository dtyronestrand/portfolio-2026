<template>
    <Form #default="{processing, wasSuccessful}" @finish="handleFinish" :action="store()" resetOnSuccess class="flex-[1 1 300px] min-w-0 max-w-[360px] p-[24px] border border(--border-card) rounded-[8px] bg-(--surface-container-low) flex flex-col gap-[20px]">
        <div class="flex flex-col gap-[4px]">
            <span class="ds-label-sm text-xs">New Skill</span>
          
            <h2 class="ds-headline-md m-0 text-xl leading-[26px]">Add New Skill</h2>
        </div>
        <label for="skillName">Skill Name</label>
        <Input v-model="newSkill.name" name="name" label="Skill Name" placeholder="Enter skill name" />
        <label for="category">Category</label>
        <Select name="skill_category_id" v-model="newSkill.categoryId">
            <SelectTrigger>
                <SelectValue placeholder="Select a category"/>
            </SelectTrigger>
            <SelectContent>

                <SelectGroup>
                    <SelectLabel>Categories</SelectLabel>
                    <SelectItem v-for="category in props.categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                    </SelectItem>
                </SelectGroup>
            </SelectContent>
        </Select>
        <div class="flex flex-col gap-[10px]">
           
            <label for="proficiency">Proficiency</label>

            <Select name="level" v-model="newSkill.proficiency">
                <SelectTrigger>

                    <SelectValue placeholder="Select Proficiency" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectLabel>Proficiency</SelectLabel>
                        <SelectItem value="25">Novice</SelectItem>
                        <SelectItem value="50">Intermediate</SelectItem>
                        <SelectItem value="75">Advanced</SelectItem>
                        <SelectItem value="100">Expert</SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>
        <Button type="button" @click="handleCancel" class="w-full">Cancel</Button>
        <Button type="submit" :disabled="processing" class="w-full">{{processing ? 'Adding...' : 'Add Skill'}}</Button>
     <div v-if="wasSuccessful">Skill added successfully!</div>
    </Form>

    
</template>

<script setup lang="ts">
import {Form} from '@inertiajs/vue3';
import { ref } from 'vue';
import { store } from "@/actions/App/Http/Controllers/SkillController";
import Input from '@/components/ui/input/Input.vue';
import {Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue, } from '@/components/ui/select/';
import Button from './ui/button/Button.vue';
interface Props {
    categories: {
        id: number;
        name: string;
        skills: {
            id: number;
            name: string;
            proficiency: number;
        }[];
    }[];
}
const props = defineProps<Props>();
const newSkill = ref({
    name: '',
    categoryId: null,
    proficiency: null,
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