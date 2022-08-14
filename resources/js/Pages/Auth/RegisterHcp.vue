<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, onMounted, watch } from "vue";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";
import JetValidationErrors from "@/Components/ValidationErrors.vue";

let showpasswd = ref(false);
let agreementScrolled = ref(false);

const form = useForm({
  firstName: "",
  lastName: "",
  email: "",
  password: "",
  password_confirmation: "",
  customerType: "hcp",
  terms: false,
  specialty: "",
  certificateType: "",
  certificateFile: null,
  resaleCertificateFile: null,
  resale: null,
  hcpType: null,
  shippingType: "Commercial",
  hcpAddress: null,
  hcpSuite: null,
  hcpCity: null,
  hcpPostcode: null,
  hcpCountry: null,
  hcpState: null,
  hcpPhoneNumber: null,
  acceptedTime: '',
  acceptedVersion: '',
  hcpLegalBusinessName: null,

});

function acceptAgreement(){
 if(agreementScrolled.value = true){
    form.acceptedTime = new Date().toLocaleString('en-US', { timeZone: 'America/Los_Angeles' })
    form.acceptedVersion = "1.01"
    console.log("Agreement accepted")
 }
}

function onScroll({ target: { scrollTop, clientHeight, scrollHeight } }) {
  if (scrollTop + clientHeight >= scrollHeight) {
    agreementScrolled.value = true;
  }
}




function showPassword() {
  const passwordField = document.querySelector("#password");

  if (passwordField.getAttribute("type") === "password") {
    showpasswd.value = true;
    passwordField.setAttribute("type", "text");
  } else {
    showpasswd.value = false;
    passwordField.setAttribute("type", "password");
  }
}

const submit = () => {
  form.post("/register/hcp", {
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


{{form}}
    <form @submit.prevent="submit">
      <div class="mt-2">
        <JetLabel for="firstName" value="First Name" />
        <JetInput
          id="firstName"
          v-model="form.firstName"
          type="text"
          class="mt-1 block w-full"
          autofocus
          autocomplete="firstName"
        />
      </div>

      <div class="mt-2">
        <JetLabel for="lastName" value="Last Name" />
        <JetInput
          id="lastName"
          v-model="form.lastName"
          type="text"
          class="mt-1 block w-full"
          autofocus
          autocomplete="lastName"
        />
      </div>

      <div class="mt-2">
        <JetLabel for="email" value="Email" />
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
        />
      </div>

      <div class="mt-2">
        <JetLabel for="confirm_email" value="Confirm Email" />
        <JetInput
          v-model="form.confirm_email"
          type="email"
          class="mt-1 block w-full"
        />
      </div>

      <hr />

      <div class="mt-2">
        <JetInput
          id="customerType"
          v-model="form.customerType"
          type="hidden"
          class="mt-1 block w-full"
          readonly
        />
      </div>

      <div class="mt-2 w-full">
        <JetLabel for="password" value="Password" />
        <div class="field has-addons">
          <div class="control is-expanded">
            <input
              type="password"
              class="input w-full rounded border-gray-300"
              id="password"
              v-model="form.password"
            />
            <button type="button" @click="showPassword" class="mt-4">
              <svg
                v-if="!showpasswd"
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                />
              </svg>
              <svg
                v-else
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                />
              </svg>
            </button>
          </div>
          <div class="control">
            <button class="button" @click="toggleShow">
              <span class="icon is-small is-right">
                <i
                  class="fas"
                  :class="{
                    'fa-eye-slash': showPassword,
                    'fa-eye': !showPassword,
                  }"
                ></i>
              </span>
            </button>
          </div>
        </div>
      </div>
      <hr />
      <div class="mt-2">
        <JetLabel for="hcpType" value="I am a .." />
        <select
          v-model="form.hcpType"
          name="hcpType"
          data-name="hcpType"
          class="internal-field w-select w-full rounded border-gray-300"
        >
          <option value="">Select Option</option>
          <option value="Acupuncturist">Acupuncturist</option>
          <option value="Adv. Reg. Nurse Practitioner">
            Adv. Reg. Nurse Practitioner
          </option>
          <option value="Certified Clinical Nutritionist">
            Certified Clinical Nutritionist
          </option>
          <option value="Certified Doula">Certified Doula</option>
          <option value="Certified Lactation Consultant">
            Certified Lactation Consultant
          </option>
          <option value="Certified Midwife">Certified Midwife</option>
          <option value="Certified Nurse Midwife">
            Certified Nurse Midwife
          </option>
          <option value="Certified Nursing Assistant">
            Certified Nursing Assistant
          </option>
          <option value="Certified Nutrition Specialist">
            Certified Nutrition Specialist
          </option>
          <option value="Certified Nutritional Consultant">
            Certified Nutritional Consultant
          </option>
          <option value="Chiropractor">Chiropractor</option>
          <option value="Clinical Herbalist">Clinical Herbalist</option>
          <option value="Dentist">Dentist</option>
          <option value="Doctor of Pharmacy">Doctor of Pharmacy</option>
          <option value="Doctorate in a Health Related Field">
            Doctorate in a Health Related Field
          </option>
          <option value="Employee">Employee</option>
          <option value="Health &amp; Wellness Coach">
            Health &amp; Wellness Coach
          </option>
          <option value="Holistic Health Practitioner">
            Holistic Health Practitioner
          </option>
          <option value="Homeopath">Homeopath</option>
          <option value="Licensed Clinical Social Worker">
            Licensed Clinical Social Worker
          </option>
          <option value="Licensed Marriage &amp; Family Therapist">
            Licensed Marriage &amp; Family Therapist
          </option>
          <option value="Licensed Mental Health Counselor">
            Licensed Mental Health Counselor
          </option>
          <option value="Licensed Practical Nurse">
            Licensed Practical Nurse
          </option>
          <option value="Licensed Vocational Nurse">
            Licensed Vocational Nurse
          </option>
          <option value="Massage Therapist">Massage Therapist</option>
          <option value="Medical Doctor">Medical Doctor</option>
          <option value="Naprapath">Naprapath</option>
          <option value="Naturopathic Doctor">Naturopathic Doctor</option>
          <option value="Nurse Practitioner">Nurse Practitioner</option>
          <option value="Nutritional Consultant">Nutritional Consultant</option>
          <option value="Occupational Therapist">Occupational Therapist</option>
          <option value="Optometrist">Optometrist</option>
          <option value="Ophthalmologist">Ophthalmologist</option>
          <option value="Oriental Medical Doctor">
            Oriental Medical Doctor
          </option>
          <option value="Osteopath">Osteopath</option>
          <option value="Pharmacist">Pharmacist</option>
          <option value="Physical Therapist">Physical Therapist</option>
          <option value="Physician Assistant">Physician Assistant</option>
          <option value="Podiatrist">Podiatrist</option>
          <option value="Psychologist">Psychologist</option>
          <option value="Registered Dental Hygienist">
            Registered Dental Hygienist
          </option>
          <option value="Registered Dietitian">Registered Dietitian</option>
          <option value="Registered Nurse">Registered Nurse</option>
          <option value="Student / Retired">Student / Retired</option>
          <option value="Veterinarian">Veterinarian</option>
          <option value="">----</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <div class="mt-2" v-if="form.hcpType === 'Medical Doctor'">
        <JetLabel for="specialty" value="Specialty" />
        <select
          name="practiceFocus"
          v-model="form.specialty"
          class="internal-field w-select w-full rounded border-gray-300"
        >
          <option value="Cardiologist">Cardiologist</option>
          <option value="Dermatologist">Dermatologist</option>
          <option value="Endocrinologist">Endocrinologist</option>
          <option value="ENT">ENT</option>
          <option value="ER">ER</option>
          <option value="General Practitioner">General Practitioner</option>
          <option value="Gastroenterology">Gastroenterology</option>
          <option value="Gynecologist">Gynecologist</option>
          <option value="Internal Medicine">Internal Medicine</option>
          <option value="Neurology">Neurology</option>
          <option value="OB/GYN">OB/GYN</option>
          <option value="Oncologist">Oncologist</option>
          <option value="Pediatrics">Pediatrics</option>
          <option value="Surgeon">Surgeon</option>
          <option value="Rheumatologist">Rheumatologist</option>
          <option value="Urologist">Urologist</option>
          <option value="Other">Other</option>
        </select>

        <hr class="mt-4" />
      </div>

      <div class="mt-2">
        <JetLabel for="address" value="Legal Business Name" />
        <JetInput
          v-model="form.hcpLegalBusinessName"
          type="text"
          class="mt-1 block w-full"
          autocomplete="business"
        />
      </div>

      <div class="mt-2">
        <JetLabel for="address" value="Address" />
        <JetInput
          v-model="form.hcpAddress"
          type="text"
          class="mt-1 block w-full"
          autocomplete="address"
        />
      </div>

      <div class="mt-2">
        <JetLabel for="suite" value="Suite" />
        <JetInput
          v-model="form.hcpSuite"
          type="text"
          class="mt-1 block w-full"
          autofocus
          autocomplete="suite"
        />
      </div>

      <div class="mt-2">
        <JetLabel for="city" value="City" />
        <JetInput
          v-model="form.hcpCity"
          type="text"
          class="mt-1 block w-full"
          autofocus
          autocomplete="city"
        />
      </div>

      <div class="mt-2 w-full">
        <JetLabel for="shippingType" value="State" />
        <select
          name="state"
          v-model="form.hcpState"
          class="internal-field w-select w-full rounded border-gray-300"
        >
          <option value="AL">Alabama</option>
          <option value="AK">Alaska</option>
          <option value="AZ">Arizona</option>
          <option value="AR">Arkansas</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="DC">District Of Columbia</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA">Washington</option>
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
        </select>
      </div>

      <div class="mt-2 w-full">
        <JetLabel for="country" value="Country" />
        <select
          name="country"
          v-model="form.country"
          class="internal-field w-select w-full rounded border-gray-300"
        >
          <option value="Afghanistan">Afghanistan</option>
          <option value="Albania">Albania</option>
          <option value="Algeria">Algeria</option>
          <option value="American Samoa">American Samoa</option>
          <option value="Andorra">Andorra</option>
          <option value="Angola">Angola</option>
          <option value="Anguilla">Anguilla</option>
          <option value="Antartica">Antarctica</option>
          <option value="Antigua and Barbuda">Antigua and Barbuda</option>
          <option value="Argentina">Argentina</option>
          <option value="Armenia">Armenia</option>
          <option value="Aruba">Aruba</option>
          <option value="Australia">Australia</option>
          <option value="Austria">Austria</option>
          <option value="Azerbaijan">Azerbaijan</option>
          <option value="Bahamas">Bahamas</option>
          <option value="Bahrain">Bahrain</option>
          <option value="Bangladesh">Bangladesh</option>
          <option value="Barbados">Barbados</option>
          <option value="Belarus">Belarus</option>
          <option value="Belgium">Belgium</option>
          <option value="Belize">Belize</option>
          <option value="Benin">Benin</option>
          <option value="Bermuda">Bermuda</option>
          <option value="Bhutan">Bhutan</option>
          <option value="Bolivia">Bolivia</option>
          <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
          <option value="Botswana">Botswana</option>
          <option value="Bouvet Island">Bouvet Island</option>
          <option value="Brazil">Brazil</option>
          <option value="British Indian Ocean Territory">
            British Indian Ocean Territory
          </option>
          <option value="Brunei Darussalam">Brunei Darussalam</option>
          <option value="Bulgaria">Bulgaria</option>
          <option value="Burkina Faso">Burkina Faso</option>
          <option value="Burundi">Burundi</option>
          <option value="Cambodia">Cambodia</option>
          <option value="Cameroon">Cameroon</option>
          <option value="Canada">Canada</option>
          <option value="Cape Verde">Cape Verde</option>
          <option value="Cayman Islands">Cayman Islands</option>
          <option value="Central African Republic">
            Central African Republic
          </option>
          <option value="Chad">Chad</option>
          <option value="Chile">Chile</option>
          <option value="China">China</option>
          <option value="Christmas Island">Christmas Island</option>
          <option value="Cocos Islands">Cocos (Keeling) Islands</option>
          <option value="Colombia">Colombia</option>
          <option value="Comoros">Comoros</option>
          <option value="Congo">Congo</option>
          <option value="Congo">Congo, the Democratic Republic of the</option>
          <option value="Cook Islands">Cook Islands</option>
          <option value="Costa Rica">Costa Rica</option>
          <option value="Cota D'Ivoire">Cote d'Ivoire</option>
          <option value="Croatia">Croatia (Hrvatska)</option>
          <option value="Cuba">Cuba</option>
          <option value="Cyprus">Cyprus</option>
          <option value="Czech Republic">Czech Republic</option>
          <option value="Denmark">Denmark</option>
          <option value="Djibouti">Djibouti</option>
          <option value="Dominica">Dominica</option>
          <option value="Dominican Republic">Dominican Republic</option>
          <option value="East Timor">East Timor</option>
          <option value="Ecuador">Ecuador</option>
          <option value="Egypt">Egypt</option>
          <option value="El Salvador">El Salvador</option>
          <option value="Equatorial Guinea">Equatorial Guinea</option>
          <option value="Eritrea">Eritrea</option>
          <option value="Estonia">Estonia</option>
          <option value="Ethiopia">Ethiopia</option>
          <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
          <option value="Faroe Islands">Faroe Islands</option>
          <option value="Fiji">Fiji</option>
          <option value="Finland">Finland</option>
          <option value="France">France</option>
          <option value="France Metropolitan">France, Metropolitan</option>
          <option value="French Guiana">French Guiana</option>
          <option value="French Polynesia">French Polynesia</option>
          <option value="French Southern Territories">
            French Southern Territories
          </option>
          <option value="Gabon">Gabon</option>
          <option value="Gambia">Gambia</option>
          <option value="Georgia">Georgia</option>
          <option value="Germany">Germany</option>
          <option value="Ghana">Ghana</option>
          <option value="Gibraltar">Gibraltar</option>
          <option value="Greece">Greece</option>
          <option value="Greenland">Greenland</option>
          <option value="Grenada">Grenada</option>
          <option value="Guadeloupe">Guadeloupe</option>
          <option value="Guam">Guam</option>
          <option value="Guatemala">Guatemala</option>
          <option value="Guinea">Guinea</option>
          <option value="Guinea-Bissau">Guinea-Bissau</option>
          <option value="Guyana">Guyana</option>
          <option value="Haiti">Haiti</option>
          <option value="Heard and McDonald Islands">
            Heard and Mc Donald Islands
          </option>
          <option value="Holy See">Holy See (Vatican City State)</option>
          <option value="Honduras">Honduras</option>
          <option value="Hong Kong">Hong Kong</option>
          <option value="Hungary">Hungary</option>
          <option value="Iceland">Iceland</option>
          <option value="India">India</option>
          <option value="Indonesia">Indonesia</option>
          <option value="Iran">Iran (Islamic Republic of)</option>
          <option value="Iraq">Iraq</option>
          <option value="Ireland">Ireland</option>
          <option value="Israel">Israel</option>
          <option value="Italy">Italy</option>
          <option value="Jamaica">Jamaica</option>
          <option value="Japan">Japan</option>
          <option value="Jordan">Jordan</option>
          <option value="Kazakhstan">Kazakhstan</option>
          <option value="Kenya">Kenya</option>
          <option value="Kiribati">Kiribati</option>
          <option value="Democratic People's Republic of Korea">
            Korea, Democratic People's Republic of
          </option>
          <option value="Korea">Korea, Republic of</option>
          <option value="Kuwait">Kuwait</option>
          <option value="Kyrgyzstan">Kyrgyzstan</option>
          <option value="Lao">Lao People's Democratic Republic</option>
          <option value="Latvia">Latvia</option>
          <option value="Lebanon" selected>Lebanon</option>
          <option value="Lesotho">Lesotho</option>
          <option value="Liberia">Liberia</option>
          <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
          <option value="Liechtenstein">Liechtenstein</option>
          <option value="Lithuania">Lithuania</option>
          <option value="Luxembourg">Luxembourg</option>
          <option value="Macau">Macau</option>
          <option value="Macedonia">
            Macedonia, The Former Yugoslav Republic of
          </option>
          <option value="Madagascar">Madagascar</option>
          <option value="Malawi">Malawi</option>
          <option value="Malaysia">Malaysia</option>
          <option value="Maldives">Maldives</option>
          <option value="Mali">Mali</option>
          <option value="Malta">Malta</option>
          <option value="Marshall Islands">Marshall Islands</option>
          <option value="Martinique">Martinique</option>
          <option value="Mauritania">Mauritania</option>
          <option value="Mauritius">Mauritius</option>
          <option value="Mayotte">Mayotte</option>
          <option value="Mexico">Mexico</option>
          <option value="Micronesia">Micronesia, Federated States of</option>
          <option value="Moldova">Moldova, Republic of</option>
          <option value="Monaco">Monaco</option>
          <option value="Mongolia">Mongolia</option>
          <option value="Montserrat">Montserrat</option>
          <option value="Morocco">Morocco</option>
          <option value="Mozambique">Mozambique</option>
          <option value="Myanmar">Myanmar</option>
          <option value="Namibia">Namibia</option>
          <option value="Nauru">Nauru</option>
          <option value="Nepal">Nepal</option>
          <option value="Netherlands">Netherlands</option>
          <option value="Netherlands Antilles">Netherlands Antilles</option>
          <option value="New Caledonia">New Caledonia</option>
          <option value="New Zealand">New Zealand</option>
          <option value="Nicaragua">Nicaragua</option>
          <option value="Niger">Niger</option>
          <option value="Nigeria">Nigeria</option>
          <option value="Niue">Niue</option>
          <option value="Norfolk Island">Norfolk Island</option>
          <option value="Northern Mariana Islands">
            Northern Mariana Islands
          </option>
          <option value="Norway">Norway</option>
          <option value="Oman">Oman</option>
          <option value="Pakistan">Pakistan</option>
          <option value="Palau">Palau</option>
          <option value="Panama">Panama</option>
          <option value="Papua New Guinea">Papua New Guinea</option>
          <option value="Paraguay">Paraguay</option>
          <option value="Peru">Peru</option>
          <option value="Philippines">Philippines</option>
          <option value="Pitcairn">Pitcairn</option>
          <option value="Poland">Poland</option>
          <option value="Portugal">Portugal</option>
          <option value="Puerto Rico">Puerto Rico</option>
          <option value="Qatar">Qatar</option>
          <option value="Reunion">Reunion</option>
          <option value="Romania">Romania</option>
          <option value="Russia">Russian Federation</option>
          <option value="Rwanda">Rwanda</option>
          <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
          <option value="Saint LUCIA">Saint LUCIA</option>
          <option value="Saint Vincent">
            Saint Vincent and the Grenadines
          </option>
          <option value="Samoa">Samoa</option>
          <option value="San Marino">San Marino</option>
          <option value="Sao Tome and Principe">Sao Tome and Principe</option>
          <option value="Saudi Arabia">Saudi Arabia</option>
          <option value="Senegal">Senegal</option>
          <option value="Seychelles">Seychelles</option>
          <option value="Sierra">Sierra Leone</option>
          <option value="Singapore">Singapore</option>
          <option value="Slovakia">Slovakia (Slovak Republic)</option>
          <option value="Slovenia">Slovenia</option>
          <option value="Solomon Islands">Solomon Islands</option>
          <option value="Somalia">Somalia</option>
          <option value="South Africa">South Africa</option>
          <option value="South Georgia">
            South Georgia and the South Sandwich Islands
          </option>
          <option value="Span">Spain</option>
          <option value="SriLanka">Sri Lanka</option>
          <option value="St. Helena">St. Helena</option>
          <option value="St. Pierre and Miguelon">
            St. Pierre and Miquelon
          </option>
          <option value="Sudan">Sudan</option>
          <option value="Suriname">Suriname</option>
          <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
          <option value="Swaziland">Swaziland</option>
          <option value="Sweden">Sweden</option>
          <option value="Switzerland">Switzerland</option>
          <option value="Syria">Syrian Arab Republic</option>
          <option value="Taiwan">Taiwan, Province of China</option>
          <option value="Tajikistan">Tajikistan</option>
          <option value="Tanzania">Tanzania, United Republic of</option>
          <option value="Thailand">Thailand</option>
          <option value="Togo">Togo</option>
          <option value="Tokelau">Tokelau</option>
          <option value="Tonga">Tonga</option>
          <option value="Trinidad and Tobago">Trinidad and Tobago</option>
          <option value="Tunisia">Tunisia</option>
          <option value="Turkey">Turkey</option>
          <option value="Turkmenistan">Turkmenistan</option>
          <option value="Turks and Caicos">Turks and Caicos Islands</option>
          <option value="Tuvalu">Tuvalu</option>
          <option value="Uganda">Uganda</option>
          <option value="Ukraine">Ukraine</option>
          <option value="United Arab Emirates">United Arab Emirates</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="United States">United States</option>
        </select>
      </div>

      <div>
        <JetLabel for="postcode" value="Postcode" />
        <JetInput
          v-model="form.postcode"
          type="text"
          class="mt-1 block w-full"
          autofocus
          autocomplete="postcode"
        />
      </div>

      <div>
        <JetLabel for="phonenumber" value="Phone Number" />
        <JetInput
          v-model="form.hcpPostcode"
          type="text"
          class="mt-1 block w-full"
          autofocus
          autocomplete="phonenumber"
        />
      </div>

      <div class="mt-2 w-full">
        <JetLabel for="shippingType" value="Shipping Type" />
        <select
          name="shippingType"
          v-model="form.shippingType"
          class="internal-field w-select w-full rounded border-gray-300"
        >
          <option value="Commercial">Commercial</option>
          <option value="Residential">Residential</option>
        </select>
      </div>
      <hr class="my-6" />

      <div class="mt-2 w-full">
        <JetLabel for="certificateType" value="Certificate Type" />
        <select
          name="certificateType"
          v-model="form.certificateType"
          class="internal-field w-select w-full rounded border-gray-300"
        >
          <option value="Type 1">Type 1</option>
          <option value="Type 2">Type 2</option>
        </select>
      </div>

      <div class="mt-2">
        <div class="bg-gray-300 p-4 rounded shadow">
          <input
            accept="application/pdf"
            type="file"
            @input="form.certificateFile = $event.target.files[0]"
          />
        </div>
      </div>

      <JetLabel for="resale">
        <div class="flex items-center my-4">
          <JetCheckbox
            id="resale"
            v-model:checked="form.resale"
            name="resale"
          />

          <div class="ml-2">
            Are you purchasing for resale to your patients?
          </div>
        </div>
      </JetLabel>

      <div class="mt-2" v-if="form.resale">
        <div class="bg-gray-300 p-4 rounded shadow">
          <p
            @scroll="onScroll"
            class="
              bg-white
              text
              black
              font-semibold
              rounded
              max-h-96
              overflow-y-scroll
            "
          >
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mollis
            sapien eu ante semper, nec porttitor mauris aliquet. Curabitur
            porttitor finibus sapien, vitae porttitor mauris consequat eget.
            Proin rutrum ex in velit faucibus, non venenatis dui suscipit. Cras
            volutpat placerat metus sed iaculis. Etiam dignissim finibus diam,
            eu tempus quam molestie ac. Sed dignissim est id mauris ultricies,
            semper dapibus enim maximus. Maecenas efficitur eros ut eleifend
            dignissim. Integer dignissim metus vel fermentum accumsan. Maecenas
            sagittis tincidunt mauris ut posuere. Sed ac sapien nunc. Ut
            dignissim interdum mauris, a malesuada risus convallis at. Nunc
            vulputate, nunc id dapibus commodo, diam nibh semper dolor, sit amet
            consequat libero nulla vitae diam. Curabitur efficitur in quam eu
            feugiat. Sed sit amet gravida elit. Sed sed aliquam nisl. Proin
            vulputate justo erat, et finibus massa imperdiet ut. Morbi sodales
            pretium vestibulum. Duis imperdiet feugiat augue, nec tempor elit
            scelerisque in. Etiam semper lectus et tincidunt malesuada. Praesent
            non ante luctus tellus finibus posuere eget non tellus. Vestibulum
            sagittis ut felis eu aliquam. Suspendisse vitae arcu efficitur,
            finibus sem et, iaculis lorem. Donec at mollis odio, sed dictum
            arcu. Phasellus et enim vitae magna tempus feugiat. Vestibulum et
            nunc quis sapien ullamcorper accumsan. Maecenas scelerisque diam a
            venenatis rutrum. Nullam at nisl maximus, dapibus ipsum ac, iaculis
            orci. Class aptent taciti sociosqu ad litora torquent per conubia
            nostra, per inceptos himenaeos. Nunc finibus dolor neque, at
            porttitor sem aliquam ut. Suspendisse odio leo, sollicitudin in
            nulla vitae, molestie tristique lectus. Maecenas consectetur luctus
            lacinia. Phasellus commodo orci vel vehicula condimentum. Praesent
            vitae dolor rhoncus, lobortis nisi sit amet, hendrerit turpis.
            Vivamus ornare sagittis neque, a posuere velit faucibus id. Donec in
            tincidunt mi. Aenean lobortis massa ligula, et mollis urna mattis
            vitae. Fusce vel ultricies velit. Donec ac volutpat dui. Ut ac justo
            ac lectus dignissim suscipit ac id ante. Proin ac accumsan mi, ac
            viverra nisi. Donec ac pharetra diam, non rutrum enim. Ut ac libero
            rhoncus, imperdiet quam imperdiet, fringilla libero. Phasellus sed
            elit vehicula nibh malesuada rhoncus ac a mi. Nunc accumsan odio
            ipsum, vitae venenatis leo consequat quis. Cras laoreet est purus,
            vitae eleifend justo blandit eget. Proin faucibus nisi et vehicula
            malesuada. Sed cursus porttitor rutrum. Quisque gravida at turpis id
            consequat. Nulla facilisi. Quisque laoreet sapien nec urna
            scelerisque posuere sed vel lacus. Integer mi leo, posuere quis
            vestibulum id, porta et lacus. Etiam ullamcorper bibendum ligula, in
            euismod nisl scelerisque a. Mauris eu turpis facilisis, sollicitudin
            lectus in, maximus dui. Suspendisse in fermentum ipsum. Maecenas in
            arcu libero. Pellentesque laoreet elit felis, in rhoncus ligula
            maximus in. Etiam molestie dui eu lectus cursus, sit amet fringilla
            diam euismod. Proin eget pellentesque turpis. Ut laoreet ex
            consequat orci vestibulum, non tincidunt dolor rhoncus. Morbi
            egestas tempus euismod. Nam venenatis nulla non bibendum luctus.
            Etiam dignissim mattis feugiat. Nullam nisi est, accumsan et ligula
            in, porta venenatis orci.
          </p>
          <div class="w-full my-4">
            <button
              :disabled="!agreementScrolled"
              :class="{ 'opacity-25 cursor-not-allowed': !agreementScrolled }"
              type="button"
              class="bg-blue-300 rounded shadow px-2 py-1"
              @click="acceptAgreement"
            >
              Accept
            </button>
          </div>

          <input
            class="mt-8"
            accept="application/pdf"
            type="file"
            @input="form.resaleCertificateFile = $event.target.files[0]"
          />
        </div>
      </div>

      <div
        v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
        class="mt-2"
      >
        <JetLabel for="terms" class="mt-16">
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

      <div class="flex items-center justify-end mt-2">
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
      </div>
    </form>
  </JetAuthenticationCard>
</template>
