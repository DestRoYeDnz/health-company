<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Welcome from "@/Components/Welcome.vue";
</script>

<template>
  <AdminLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Admin Area
      </h2>
    </template>

        <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
          <div
            class="
              bg-white
              overflow-hidden
              shadow-xl
              sm:rounded-lg
              p-4
              flex
              justify-between
              items-center
            "
          >

          </div>
          
        </div>
      </div>
    </div>


  </AdminLayout>
    
</template>

<script>
export default {};
</script>

<style>
</style>