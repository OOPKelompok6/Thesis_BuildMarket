<x-headLayout>
  <div id="screenContainer" class="d-flex flex-row min-vh-100 min-vw-100">
    <div id="mainContainer"class="d-flex flex-column bg-light min-vh-100 w-50">
      <a href="/">
        <i class="bi bi-house fs-2 ms-1"></i>
      </a>

      <x-authShared.authFormField method="POST" action="/register">
        @csrf
        <div id="welcomeText" class="d-flex flex-column mb-4 w-75">
          <p class="fs-6">Welcome!</p>
          <p class="display-6 fw-bolder">Create an account</p>
        </div>
        <x-formTextFields class="w-75"
          message="Email" name="email" type="email" formId="emailInput" innerClass="form-control bg-light">
        </x-formTextFields>
        <x-formTextFields class="w-75"
          message="First Name" name="firstName" type="text" formId="firstNameInput" innerClass="form-control bg-light">
        </x-formTextFields>
        <x-formTextFields class="w-75"
          message="Last Name" name="lastName" type="text" formId="lastNameInput" innerClass="form-control bg-light">
        </x-formTextFields>
        <x-formTextFields class="w-75"
          message="Password" name="password" type="password" formId="passwordInput" innerClass="form-control bg-light">
        </x-formTextFields>
        <x-authShared.authButtons message="Register" type="submit"/>
        <x-authShared.accountConfirmText id="loginHelp" 
        message="Already have an account?"
        messageLink="/login"
        messageText="Log In">
        </x-authShared.accountConfirmText>
      </x-authShared.authFormField>
    </div>
    
    <div id="logo" class="d-flex align-items-center bg-dark min-vh-100 w-50 rounded-start-4">
      <div class="mx-auto"><p class="display-1 text-light">BuildMarket</p></div>
    </div>
  </div>
</x-headLayout>