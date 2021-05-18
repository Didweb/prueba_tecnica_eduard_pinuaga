<?php

namespace App\Controller;

use App\Services\Questions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class QuestionController extends AbstractController
{
    /**
     * @Route("/api/questions", name="api_questions", methods={"GET"}))
     */
    public function getQuestion(HttpClientInterface $client, Request $request): Response
    {
        $tagged = $request->get('tagged');
        $fromDate = $request->get('fromdate');
        $toDate = $request->get('todate');

        $serviceQuestions = new Questions($client);

        return new JsonResponse($serviceQuestions->getQuestions($tagged, $fromDate, $toDate));
    }
}