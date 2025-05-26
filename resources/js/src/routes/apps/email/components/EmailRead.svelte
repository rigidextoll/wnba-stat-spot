<script lang="ts">
    import QuillEditor from "$lib/components/QuillEditor.svelte";
    import {Button} from "@sveltestrap/sveltestrap";

    const smallImg1 = '/images/small/img-1.jpg'
    const smallImg2 = '/images/small/img-2.jpg'
    const smallImg3 = '/images/small/img-3.jpg'

    const avatar2 = '/images/users/avatar-2.jpg'
    const avatar7 = '/images/users/avatar-7.jpg'


    const editorOptions = {
        modules: {
            'toolbar': [[{font: []}, {size: []}], ['bold', 'italic', 'underline', 'strike'], [{color: []}, {background: []}], [{script: 'super'}, {script: 'sub'}], [{header: [false, 1, 2, 3, 4, 5, 6]}, 'blockquote', 'code-block'], [{list: 'ordered'}, {list: 'bullet'}, {indent: '-1'}, {indent: '+1'}], ['direction', {align: []}], ['link', 'image', 'video'], ['clean']]
        },
        theme: "snow",
    }
</script>

<div data-simplebar>
    <div class="px-3">
        <div class="mt-2">
            <h5>Hi Jorge, How are you?</h5>
            <hr/>
            <div class="d-flex mb-4 mt-1">
                <img class="me-2 rounded-circle avatar-sm" src="{avatar2}" alt="Generic placeholder img"/>
                <div class="flex-grow-1">
                    <span class="float-end">07:23 AM</span>
                    <h6 class="m-0">Jonathan Smith</h6>
                    <small class="text-muted">From: jonathan@domain.com</small>
                </div>
            </div>

            <p><b>Hi Jorge...</b></p>
            <div class="text-muted">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                    massa.Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                    quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                <p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                    In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis
                    pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                <p>
                    Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,
                    enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut
                    metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                    ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum
                    rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit
                    vel, luctus pulvinar
                </p>
            </div>
            <hr/>
            <h6><i class="fa fa-paperclip mb-2"></i> Attachments <span>(3)</span></h6>

            <div>
                <a href={"#"}>
                    <img src="{smallImg1}" alt="attachment" style="height: 84px" class="img-thumbnail me-1"/>
                </a>
                <a href={"#"}>
                    <img src="{smallImg2}" alt="attachment" style="height: 84px" class="img-thumbnail me-1"/>
                </a>
                <a href={"#"}>
                    <img src="{smallImg3}" alt="attachment" style="height: 84px" class="img-thumbnail me-1"/>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="p-3">
    <div class="d-flex">
        <img class="me-2 rounded-circle avatar-sm" src="{avatar7}" alt="Generic placeholder img"/>
        <div class="flex-grow-1">
            <div class="mb-2">
                <QuillEditor id="snow-editor" height="{200}" options={editorOptions}>
                    <h3>This is an Air-mode editable area.</h3>
                    <p><br></p>
                    <ul>
                        <li>Select a text to reveal the toolbar.</li>
                        <li>Edit rich document on-the-fly, so elastic!</li>
                    </ul>
                    <p><br></p>
                    <p>End of air-mode area</p>
                </QuillEditor>
            </div>
        </div>
    </div>

    <div class="text-end">
        <Button type="button" color="primary" class="width-sm"> Send</Button>
    </div>
</div>