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
            <div class="flex justify-between items-center w-full">
              <a
              href="/admin/users"
                class="
                  bg-blue-500
                  hover:bg-blue-700
                  text-white
                  font-bold
                  py-2
                  px-4
                  rounded
                "
              >
                Users
              </a>
              <a
              href="/admin/sentemails"
                class="
                  bg-orange-500
                  hover:bg-blue-700
                  text-white
                  font-bold
                  py-2
                  px-4
                  rounded
                "
              >
                Sent Emails
              </a>
              <a
              href="/admin/log-viewer"
                class="
                  bg-green-500
                  hover:bg-blue-700
                  text-white
                  font-bold
                  py-2
                  px-4
                  rounded
                "
              >
                Logs
              </a>
            </div>
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