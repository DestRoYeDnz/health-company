<template>
  <table class="table-auto w-full">
    <thead>
      <tr>
        <th align="left">Name</th>
        <th align="left">Email</th>
        <th align="left">Customer Type</th>
        <th align="left">Customer Status</th>
      </tr>
    </thead>
    </table>
      <table class="table-auto w-full">
    <tbody>
      <tr>
        <td align="left" class="align-top">
          {{ props.user.firstName }} {{ props.user.lastName }}
        </td>
        <td align="left" class="align-top">{{ props.user.email }}</td>
        <td align="left" class="align-top">{{ props.user.customerType }}</td>
        <td align="left" class="align-top">{{ props.user.hcpStatus }}</td>
        <td>
          <div
            class="
              align-top
              px-2
              py-1
              rounded
              shadow
              text-white text-lg
              font-bold
              text-center
            "
            v-if="props.user.customerType == 'hcp'"
          >
            <div v-if="props.user.customerType == 'hcp'">
              <div class="flex items-center justify-between flex-col">
                <select
                  v-model="form.newValue"
                  class="text-sm px-1 py-1 text-black w-full"
                >
                  <option value="Pending">Pending</option>
                  <option value="Active">Active</option>
                  <option value="Personal use only">Personal use only</option>
                  <option value="Rejected">Rejected</option>
                  <option value="Not Responding">Not Responding</option>
                </select>

                <select
                  v-model="form.action"
                  class="text-sm px-1 py-1 text-black w-full"
                >
                  <option value="Yes">Send Email / Hubspot</option>
                  <option value="No">Dont send any Action</option>
                </select>
              </div>
            </div>
            <button
              @click="submit"
              class="bg-blue-300 w-full rounded px-2 py-0 text-sm"
            >
              change
            </button>
          </div>
          <div
            class="
              align-top
              px-2
              py-1
              rounded
              shadow
              text-white text-lg
              font-bold
              text-center
            "
            v-else
          >
            <div v-if="props.user.customerType == 'hcp'">
              <div class="flex items-center justify-between flex-col">
                <select
                  v-model="form.newValue"
                  class="text-sm px-1 py-1 text-black w-full"
                >
                  <option value="Pending">Pending</option>
                  <option value="Active">Active</option>
                  <option value="Personal use only">Personal use only</option>
                  <option value="Rejected">Rejected</option>
                  <option value="Not Responding">Not Responding</option>
                </select>

                <select
                  v-model="form.action"
                  class="text-sm px-1 py-1 text-black w-full"
                >
                  <option value="Yes">Send Email / Hubspot</option>
                  <option value="No">Dont send any Action</option>
                </select>
              </div>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
<div class='w-full h-1 bg-gray-200'>-</div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

function submit() {
  Inertia.post("/user", form),{
  preserveScroll: true,
  onSuccess: () => console.log("YES")
  };
}

const props = defineProps(["user"]);

const form = useForm({
  oldValue: props.user.hcpStatus,
  newValue: props.user.hcpStatus,
  userId: props.user.id,
  action: "Yes",
});
</script>