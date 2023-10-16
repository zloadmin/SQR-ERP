@if((new \Jenssegers\Agent\Agent())->isMobile())
    <script>
        let current_zoom = 100;
        let current_zoom_scale = 1.0;

        function zoomOut() {
            // setZoom(getCurrentZoom() - 10);
            setZoomScale(getCurrentZoomScale() - 0.1);

        }

        function zoomIn() {
            // setZoom(getCurrentZoom() + 10);
            setZoomScale(getCurrentZoomScale() + 0.1);

        }

        function getCurrentZoom() {
            let zoom = document.body.style.zoom;
            return zoom ? parseInt(zoom) : 100;
        }

        function getCurrentZoomScale() {
            return current_zoom_scale;
        }

        function setZoom(zoom) {
            console.log('Set zoom is ' + zoom);
            document.body.style.zoom = zoom + '%';
        }
        function scrollZoomDivStyle()
        {
            // let topOffset =  window.pageYOffset;
            // let currentTop = getZoomTop();
            let setTop = getZoomTop();
            // // let setTop = topOffset + currentTop;
            // console.log('topOffset ' + topOffset);
            // console.log('currentTop ' + currentTop);
            // console.log('setTop ' + setTop);
            document.getElementById('zoomDiv').style.top = setTop + 'px';
        }
        function initZoomDivStyle()
        {
            let top_px = getZoomTop();
            document.getElementById('zoomDiv').style.top = top_px + 'px';
            document.getElementById('zoomDiv').style.display = 'block';
        }
        function getZoomTop()
        {

            let body_height_percent = document.getElementsByTagName('body')[0].style.height;
            let topOffset = 0;
            if(!body_height_percent) {
                body_height_percent = 100;
            } else {
                topOffset =  window.pageYOffset;
                if(topOffset > 0) {
                    topOffset = topOffset * (parseInt(body_height_percent) / 100);
                    // console.log('body_height_percent ' + body_height_percent);
                    // console.log('Real offset ' + window.pageYOffset);
                    // console.log('Add offset ' + topOffset);

                }

            }
            let top_px = window.innerHeight * (parseInt(body_height_percent) / 100) * 0.92;
            // console.log(body_height_percent);
            // console.log(top_px);
            return top_px + topOffset;
        }
        function setZoomScale(scale) {
            // let scale = 'scale(' + zoom + ')';
            if(scale < 0.1 || scale > 2) {
                console.log('skip');
                return;
            } else {
                console.log(scale);
            }
            current_zoom_scale = scale;
            document.body.style.transform = "scale(" + scale + ")";
            document.body.style.transformOrigin = "top left";
            document.body.style.width = (100 / scale) + "%";
            document.body.style.height = (100 / scale) + "%";
            initZoomDivStyle();




            // document.body.style.webkitTransform =         // Chrome, Opera, Safari
            //     document.body.style.msTransform =           // IE 9
            //         document.body.style.transform = scale;
            // console.log(scale);
            // document.body.style.webkitTransform = scale;
            // document.body.style.MozTransform = scale;
            // document.body.style.OTransform = scale;
            // document.body.style.msTransform = scale;
            // document.body.style.transform = scale;
            // console.log('Set zoom is ' + zoom);
            // document.body.style.zoom = zoom + '%';
        }
        document.addEventListener("DOMContentLoaded", function(){
            console.log('DOMContentLoaded');
            initZoomDivStyle();
        });
        window.onscroll = scrollZoomDivStyle; /* Call the function when the user scrolls */
        // window.onresize = initZoomDivStyle; /* Call the function when the window resizes */
    </script>
@endif
