<?php

use Illuminate\Database\Seeder;

use App\Question;
use App\Answer;

class QuestionAnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $questions = [
			[
				'title' => 'The abhorrent nature of shirk',
				'slug' => 'the-abhorrent-nature-of-shirk',
				'description' => 'What is meant by the words of Shaykh al-Islam Ibn Taymiyah (may Allah have mercy on him): The description of being a mushrik [one who associates others with Allah] is valid and is confirmed even if the message has not reached him, because he is associating others with his Lord and regarding false gods as being equal to Allah?',
				'created_by' => 1,
				'status' => 'active',
				'category_id' => 1,
				'language' => 'en',
			],
			[
				'title' => 'The nature of shirk',
				'slug' => 'the-nature-of-shirk',
				'description' => 'What is meant by the words of Shaykh al-Islam Ibn Taymiyah (may Allah have mercy on him): The description of being a mushrik [one who associates others with Allah] is valid and is confirmed even if the message has not reached him, because he is associating others with his Lord and regarding false gods as being equal to Allah?',
				'created_by' => 1,
				'status' => 'active',
				'category_id' => 1,
				'language' => 'en',
			],
        ];
        $answers = [
        	[
        		'batch_id' => 1,
        		'language' => 'en',
        		'description' => 'Praise be to Allah.
        				What Shaykh al-Islam Ibn Taymiyah (may Allah have mercy on him) meant by these words was to highlight that shirk is wrong and blameworthy, and that the one who commits shirk is to be described as a mushrik; his action is abhorrent and blameworthy, regardless of whether or not proof with evidence has been established against the mushrik, because shirk is abhorrent in all cases, before the sending of the message and afterwards.',
        		'category_id' => 1
        	],
        	[
        		'batch_id' => 1,
        		'language' => 'ar',
        		'description' => ' الأول : بيان ذم الشرك وقبحه وأنه شر كله ، وهذا وصف ذاتي له ، لا ينفك عنه ، سواء كان قبل قيام الحجة بإرسال الرسول وإنزال الكتاب ، أو كان بعد ذلك ، والمشرك : هو من وقع في هذا الأمر ، واتصف به ؛ فعدم قيام الحجة لا يغير الأسماء الشرعية . ',
        		'category_id' => 1
        	],
        	[
        		'batch_id' => 1,
        		'language' => 'bn',
        		'description' => ' দুঃখিত, আপনি যে পেইজটি দেখতে চাচ্ছেন সেটা নেই ',
        		'category_id' => 1
        	],
		];

		foreach ($questions as $key => $question_arr) {
			$question = Question::create($question_arr);
			foreach ($answers as $ans_arr) {
				$ans_arr['question_id'] = $question->id;
				$ans_arr['category_id'] = $question->category_id;
				$ans_arr['batch_id'] = $question->id;
				$answer = Answer::create($ans_arr);
			}
		}
    }
}
