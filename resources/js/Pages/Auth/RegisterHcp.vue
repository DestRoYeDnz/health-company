<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";
import JetValidationErrors from "@/Components/ValidationErrors.vue";

const form = useForm({
  firstName: "",
  lastName: "",
  email: "",
  password: "",
  password_confirmation: "",
  customerType: "hcp",
  terms: false,
  specialty: '',
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <Head title="Register Professional" />

  <JetAuthenticationCard>
    <template #logo>
      <h1>Register Professional</h1>
    </template>

    <JetValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <JetLabel for="firstName" value="First Name" />
        <JetInput
          id="firstName"
          v-model="form.firstName"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="firstName"
        />
      </div>

      <div>
        <JetLabel for="lastName" value="Last Name" />
        <JetInput
          id="lastName"
          v-model="form.lastName"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="lastName"
        />
      </div>

            <div class="mt-4">
                <JetLabel for="email" value="Email" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                />
            </div>

      <div class="mt-4">
        <JetLabel for="specialty" value="Specialty" />
        <select
          id="specialty"
          v-model="form.specialty"
          class="mt-1 block w-full"
        >
        <option value="test">Test</option>
        </select>
      </div>


      <div class="mt-4">
        <JetLabel for="customerType" value="Customer Type" />
        <JetInput
          id="customerType"
          v-model="form.customerType"
          type="text"
          class="mt-1 block w-full"
          required
          readonly
        />
      </div>

      <div class="mt-4">
        <JetLabel for="password" value="Password" />
        <JetInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4">
        <JetLabel for="password_confirmation" value="Confirm Password" />
        <JetInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
      </div>

      <div
        v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
        class="mt-4"
      >
        <JetLabel for="terms">
          <div class="flex items-center">
            <JetCheckbox id="terms" v-model:checked="form.terms" name="terms" />

            <div class="ml-2">
              I agree to the
              <a
                target="_blank"
                :href="route('terms.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
                >Terms of Service</a
              >
              and
              <a
                target="_blank"
                :href="route('policy.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
                >Privacy Policy</a
              >
            </div>
          </div>
        </JetLabel>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          Already registered?
        </Link>

        <JetButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Register
        </JetButton>

        {{form}}
      </div>
    </form>
  </JetAuthenticationCard>
</template>
