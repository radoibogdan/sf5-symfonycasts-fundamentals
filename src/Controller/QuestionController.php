<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Sentry\State\HubInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController
{

    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var bool
     */
    private $isDebug;

    public function __construct(LoggerInterface $logger, bool $isDebug)
    {
        $this->logger = $logger;
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Environment $twigEnvironment)
    {
        /*
        // fun example of using the Twig service directly!
        $html = $twigEnvironment->render('question/homepage.html.twig');

        return new Response($html);
        */

        return $this->render('question/homepage.html.twig');
    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     */
    public function show($slug, MarkdownHelper $markdownHelper, HubInterface $hub)
    {
        // Check SENTRY_DSN for sentry
//        dump($hub->getClient());

        // Send Exception to Sentry.io
//        throw new \Exception('bad');

        if ($this->isDebug) {
            $this->logger->info('Mode debug du QuestionController.');
        }

        $answers = [
            'Make sure your cat is sitting `purrrfectly` still 🤣',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];

        // Trouve parametre dans packages/cache
//        dump($this->getParameter('cache_adapter_bogdan'));

        $questionText = 'I\'ve been turned into a cat, any *thoughts* on how to turn back? While I\'m **adorable**, I don\'t really care for cat food.';
        $parsedQuestionText = $markdownHelper->parse($questionText);

        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'questionText' => $parsedQuestionText,
            'answers' => $answers,
        ]);
    }
}
