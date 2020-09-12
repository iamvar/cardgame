<?php
declare(strict_types=1);

namespace Iamvar\CardGame\Command;

use Iamvar\CardGame\Entity\Player;
use Iamvar\CardGame\Service\TwentyOneService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class TwentyOneCommand extends Command
{
    protected static $defaultName = 'game:21';

    protected function configure()
    {
        $this->setDescription('You should pick cards to get score as close to 21 as possible');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $computer = new Player('Computer');
        $human = new Player('Player');

        $twentyOneService = new TwentyOneService($computer, $human);
        $this->pickingCardsInfo($output, $computer->getName());

        do {
            $twentyOneService->pickCardForPlayer($computer);
        } while ($computer->getScore() + $twentyOneService->checkNextCardScore() <= TwentyOneService::MAX_SCORE);

        $questionHelper = new QuestionHelper();
        $question = new ConfirmationQuestion('Pick a card (yes/no)?', false);

        $this->pickingCardsInfo($output, $human->getName());

        do {
            $score = $twentyOneService->pickCardForPlayer($human);
            $output->writeln("You picked {$score}. Your score is {$human->getScore()}");
            if ($human->getScore() >= TwentyOneService::MAX_SCORE) {
                break;
            }

            $pickNext = $questionHelper->ask($input, $output, $question);
        } while ($pickNext);

        foreach ($twentyOneService->getPlayers() as $player) {
            $output->writeln("{$player->getName()} score: {$player->getScore()}");
        }

        foreach ($twentyOneService->getWinners() as $winner) {
            $output->writeln("{$winner->getName()} won!");
        }

        return self::SUCCESS;
    }

    private function pickingCardsInfo(OutputInterface $output, string $playerName): void
    {
        $output->writeln("{$playerName} is picking cards");
    }

}