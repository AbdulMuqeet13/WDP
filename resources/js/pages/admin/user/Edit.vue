<script setup lang="ts">
  import AppLayout from '@/layouts/AppLayout.vue';


  const props = defineProps<{
      user: Object
  }>()


  import { h, ref } from 'vue';
  import { Button } from "@/components/ui/button"
  import {
      FormControl,
      FormDescription,
      FormField,
      FormItem,
      FormLabel,
      FormMessage,
  } from "@/components/ui/form"
  import { Input } from "@/components/ui/input"

  const form = ref(props.user);

  const onSubmit = () => {

  }

</script>

<template>

    <app-layout>
        <form class="w-2/3 ml-16 mt-8 space-y-4" @submit="onSubmit">

            <FormField v-slot="{ componentField }" name="name">
                <FormItem>
                    <FormLabel>Name</FormLabel>
                    <FormControl>
                        <Input type="text" placeholder="Era Sachl" v-model="user.name"/>
                    </FormControl>
                    <FormMessage />
                </FormItem>
            </FormField>

            <FormField v-slot="{ componentField }" name="email">
                <FormItem>
                    <FormLabel>Email</FormLabel>
                    <FormControl>
                        <Input type="email" placeholder="EraSachl.com" v-model="user.email"/>
                    </FormControl>
                    <FormMessage />
                </FormItem>
            </FormField>

            <FormField v-slot="{ componentField }" name="referralCode">
                <FormItem>
                    <FormLabel>Referral Code</FormLabel>
                    <FormControl>
                        <Input type="text" placeholder="DFG578" v-model="user.referralCode"/>
                    </FormControl>
                    <FormMessage />
                </FormItem>
            </FormField>

            <FormField v-slot="{ componentField }" name="joiningDate">
                <FormItem>
                    <FormLabel>Joining Date</FormLabel>
                    <FormControl>
                        <Input type="date" v-model="user.joiningDate"/>
                    </FormControl>
                    <FormMessage />
                </FormItem>
            </FormField>

            <Button type="submit">
                Submit
            </Button>
        </form>
    </app-layout>
</template>
