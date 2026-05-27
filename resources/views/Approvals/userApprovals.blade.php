<x-layout>
    <div class="d-flex flex-column w-100 min-vh-100 align-items-center">
        @can('approvalExist', App\Models\Approval::class)
            <p class="h1 text-light fw-bold mt-5 pt-5">Become a verified seller!</p>
            <p style="opacity: 0.5;" class="fs-5 text-light fw-bold mt-5">Start selling on Buildmarket. With easy upload and verification</p>
            
            <form class="d-flex flex-column w-75 mb-5" method="POST" enctype="multipart/form-data" action="/sellerRequest">
                @csrf

                <div class="div-flex my-4 mb">
                    <label for="formNPWP" class="fs-3 text-light form-label">NPWP Number</label>
                    <input placeholder="9990000000999000" name="npwp_number" class="form-control" type="text" id="formNPWP">
                    <x-errorValidationLabel name="npwp_number"></x-errorValidationLabel>
                </div>

                <div class="div-flex my-4">
                    <label for="formFile" class="fs-3 text-light form-label">NIB Document</label>
                    <input class="form-control" name="NIBDocument" type="file" id="formFile">
                     <x-errorValidationLabel name="NIBDocument"></x-errorValidationLabel>
                </div>
                <x-generalButton buttonType="button" type="submit" class="mx-auto w-25 my-5 text-light bg-primary" message="Upload"></x-generalButton>
            </form>
        @else
            <div class="d-flex flex-column h-100 my-auto">
                <p class="h1 text-light fw-bold mt-5 pt-5 text-center">Your request for seller role is being processed</p>
                <p style="opacity: 0.5;" class="fs-5 text-light fw-bold mt-5 text-center">Please wait as we processed your files and file it for administrative purposes</p>
            </div>
        @endcan
    </div>
</x-layout>