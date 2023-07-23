<?php


// add_action('wp_footer', function () {
//     	global $post;
//     	logger( $post );
//     	$blocks = parse_blocks( $post->post_content );
//     	foreach( $blocks as $block ) {
//     			logger( $block ); 
//     	}
// });


/**
 * Pretty Printing
 */
function logger($obj, $label = '')
{
    $data = json_encode(print_r($obj, true));
?>
    <style>
        #bsdLogger {
            counter-reset: section;
            position: fixed;
            top: 0;
            left: 0px;
            border-left: 4px solid #bbb;
            padding: 4rem 0.5% 6rem;
            background-color: black;
            color: #121212;
            z-index: 999;
            font-size: 0.75rem;
            width: 400px;
            height: 100vh;
            height: 100dvh;
            overflow-y: scroll;
            overflow-x: hidden;
            user-select: text;
        }

        #bsdLogger:hover {
            width: fit-content;
        }

        #bsdLogger pre {
            font-size: 12px;
            background-color: #121212;
            color: lightsteelblue;
            border: 1px dotted slategray;
            white-space: pre-line;
            overflow-x: auto;

        }

        #bsdLogger pre:hover,
        #bsdLogger pre:focus {
            width: fit-content;
            cursor: text;
            color: dodgerblue;
        }

        #bsdLogger pre::before {
            counter-increment: section;
            content: "Item " counter(section) ": ";
            color: crimson;
            font-weight: bold;
        }
    </style>
    <script type="text/javascript">
        var doStuff = function() {
            var obj = <?php echo $data; ?>;
            var logger = document.getElementById('bsdLogger');

            if (!logger) {
                logger = document.createElement('div');
                logger.id = 'bsdLogger';
                document.body.appendChild(logger);
                logger.addEventListener("click", (evt) => {
                    if (evt.ctrlKey) {
                        evt.target.remove();
                    }
                })
            }
            console.log("++++++++++++++++++++++++++++++++++++++");
            console.log(obj);
            console.log("++++++++++++++++++++++++++++++++++++++");
            var pre = document.createElement('pre');
            var h2 = document.createElement('h2');
            pre.innerHTML = obj;
            //h2.innerHTML = '<?php #echo addslashes($label); 
                                ?> ';
            // logger.appendChild(h2);
            logger.appendChild(pre);


        };
        window.addEventListener("load", doStuff, false);
    </script>
<?php
}
