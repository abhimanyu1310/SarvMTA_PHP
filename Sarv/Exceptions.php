<?php

class Sarv_Error extends Exception {}
class Sarv_HttpError extends Sarv_Error {}

/**
 * The parameters passed to the API call are invalid or not provided when required
 */
class Sarv_ValidationError extends Sarv_Error {}

/**
 * The provided API key is not a valid Sarv API key
 */
class Sarv_Invalid_Key extends Sarv_Error {}

