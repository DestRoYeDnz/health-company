<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
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
            <div>
              {{ $page.props.user.firstName }} {{ $page.props.user.lastName }}
            </div>
            <div class="flex items-center justify-end space-x-2">
              <button
                class="
                  h-8
                  rounded-full
                  bg-red-500
                  px-2
                  py-1
                  text-white
                  font-semibold
                "
              >
                {{ $page.props.user.customerType.toUpperCase() }}
              </button>

              <button
                class="
                  h-8
                  rounded-full
                  bg-purple-500
                  px-2
                  py-1
                  text-white
                  font-semibold
                "
              >
                hcpType: {{ $page.props.user.hcpStatus }}
              </button>

              <button
                class="
                  h-8
                  rounded-full
                  bg-blue-500
                  px-2
                  py-1
                  text-white
                  font-semibold
                "
              >
                isVerified: {{ $page.props.user.isVerified }}
              </button>
              <button
                class="
                  h-8
                  rounded-full
                  bg-green-500
                  px-2
                  py-1
                  text-white
                  font-semibold
                "
              >
                isEmployee: {{ $page.props.user.isEmployee }}
              </button>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </AppLayout>
</template>
