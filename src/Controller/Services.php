<?php

/**
 * @file
 * Contains Drupal\services\Controller\Services.
 */

namespace Drupal\services\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Services.
 *
 * @package Drupal\services\Controller
 */
class Services extends ControllerBase {
  /**
   * Processing the API request.
   */
  public function processRequest(Request $request, RouteMatchInterface $route_match, $service_api_id, $service_definition_id) {
    /** @var $service_api \Drupal\services\ServiceAPIInterface */
    $service_api = \Drupal::entityManager()->getStorage('service_api')->load($service_api_id);

    //TODO - pull in settings from service API and alter response

    /** @var $service_def \Drupal\services\ServiceDefinitionInterface */
    $service_def = \Drupal::getContainer()->get('plugin.manager.services.service_definition')->createInstance($service_definition_id, []);
    return new Response($service_def->processRequest($request, $route_match));
  }
}
