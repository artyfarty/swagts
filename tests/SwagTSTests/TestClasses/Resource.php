<?php
/**
 * @author artyfarty
 */

namespace SwagTSTests\TestClasses;

/**
 * @SWG\Resource(
 *     apiVersion="0.2",
 *     swaggerVersion="2.0",
 *     resourcePath="/",
 *     basePath="http://localhost/"
 * )
 */

class Resource {
    /**
     * @SWG\Api(
     *   path="/",
     *   @SWG\Operation(
     *     summary="barbaz",
     *     method="GET",
     *     type="SimpleClass"
     *  )
     * )
     *
     */
    public function dummy() {

    }
}