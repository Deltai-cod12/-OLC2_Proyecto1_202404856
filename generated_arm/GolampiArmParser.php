<?php

/*
 * Generated from GolampiArm.g4 by ANTLR 4.13.2
 */

namespace generated_arm {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class GolampiArmParser extends Parser
	{
		public const FUNC = 1, VAR = 2, CONST = 3, NIL = 4, IF = 5, ELSE = 6, 
               SWITCH = 7, CASE = 8, DEFAULT = 9, FOR = 10, BREAK = 11, 
               CONTINUE = 12, RETURN = 13, INT_TYPE = 14, FLOAT_TYPE = 15, 
               BOOL_TYPE = 16, STRING_TYPE = 17, RUNE_TYPE = 18, TRUE = 19, 
               FALSE = 20, IN = 21, NOT_KW = 22, LPAREN = 23, RPAREN = 24, 
               LBRACE = 25, RBRACE = 26, LBRACK = 27, RBRACK = 28, SEMICOLON = 29, 
               COMMA = 30, COLON = 31, RANGE = 32, DOT = 33, EQUAL = 34, 
               NOT_EQUAL = 35, LESS_EQUAL = 36, GREATER_EQUAL = 37, LESS = 38, 
               GREATER = 39, ASSIGN = 40, SHORT_ASSIGN = 41, PLUS_ASSIGN = 42, 
               MINUS_ASSIGN = 43, MULT_ASSIGN = 44, DIV_ASSIGN = 45, INC = 46, 
               DEC = 47, AND = 48, OR = 49, BANG = 50, PLUS = 51, MINUS = 52, 
               MULT = 53, DIV = 54, MOD = 55, AMP = 56, STRING = 57, FLOAT_LITERAL = 58, 
               INT_LITERAL = 59, RUNE_LITERAL = 60, IDENTIFIER = 61, LINE_COMMENT = 62, 
               BLOCK_COMMENT = 63, WS = 64, ERROR_CHAR = 65;

		public const RULE_program = 0, RULE_functionDecl = 1, RULE_params = 2, 
               RULE_param = 3, RULE_returnTypes = 4, RULE_block = 5, RULE_statement = 6, 
               RULE_statementCore = 7, RULE_varDecl = 8, RULE_constDecl = 9, 
               RULE_shortVarDecl = 10, RULE_assignment = 11, RULE_assignTarget = 12, 
               RULE_assignOp = 13, RULE_idList = 14, RULE_expList = 15, 
               RULE_type = 16, RULE_baseType = 17, RULE_pointerType = 18, 
               RULE_arrayType = 19, RULE_arrayDimension = 20, RULE_arrayLiteral = 21, 
               RULE_arrayElements = 22, RULE_arrayElement = 23, RULE_arrayAccess = 24, 
               RULE_arrayIndex = 25, RULE_pointerAccess = 26, RULE_functionCall = 27, 
               RULE_functionName = 28, RULE_args = 29, RULE_rangeExp = 30, 
               RULE_expression = 31, RULE_logicalOrExp = 32, RULE_logicalAndExp = 33, 
               RULE_equalityExp = 34, RULE_relationalExp = 35, RULE_additiveExp = 36, 
               RULE_multiplicativeExp = 37, RULE_unaryExp = 38, RULE_primary = 39, 
               RULE_ifStmt = 40, RULE_switchStmt = 41, RULE_caseClause = 42, 
               RULE_defaultClause = 43, RULE_forStmt = 44, RULE_forClause = 45, 
               RULE_simpleStmt = 46, RULE_incDecStmt = 47, RULE_shortVarDeclNoSemi = 48, 
               RULE_assignmentNoSemi = 49, RULE_breakStmt = 50, RULE_continueStmt = 51, 
               RULE_returnStmt = 52;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'program', 'functionDecl', 'params', 'param', 'returnTypes', 'block', 
			'statement', 'statementCore', 'varDecl', 'constDecl', 'shortVarDecl', 
			'assignment', 'assignTarget', 'assignOp', 'idList', 'expList', 'type', 
			'baseType', 'pointerType', 'arrayType', 'arrayDimension', 'arrayLiteral', 
			'arrayElements', 'arrayElement', 'arrayAccess', 'arrayIndex', 'pointerAccess', 
			'functionCall', 'functionName', 'args', 'rangeExp', 'expression', 'logicalOrExp', 
			'logicalAndExp', 'equalityExp', 'relationalExp', 'additiveExp', 'multiplicativeExp', 
			'unaryExp', 'primary', 'ifStmt', 'switchStmt', 'caseClause', 'defaultClause', 
			'forStmt', 'forClause', 'simpleStmt', 'incDecStmt', 'shortVarDeclNoSemi', 
			'assignmentNoSemi', 'breakStmt', 'continueStmt', 'returnStmt'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'func'", "'var'", "'const'", "'nil'", "'if'", "'else'", "'switch'", 
		    "'case'", "'default'", "'for'", "'break'", "'continue'", "'return'", 
		    null, null, "'bool'", "'string'", "'rune'", "'true'", "'false'", "'in'", 
		    "'not'", "'('", "')'", "'{'", "'}'", "'['", "']'", "';'", "','", "':'", 
		    "'..'", "'.'", "'=='", "'!='", "'<='", "'>='", "'<'", "'>'", "'='", 
		    "':='", "'+='", "'-='", "'*='", "'/='", "'++'", "'--'", "'&&'", "'||'", 
		    "'!'", "'+'", "'-'", "'*'", "'/'", "'%'", "'&'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, "FUNC", "VAR", "CONST", "NIL", "IF", "ELSE", "SWITCH", "CASE", 
		    "DEFAULT", "FOR", "BREAK", "CONTINUE", "RETURN", "INT_TYPE", "FLOAT_TYPE", 
		    "BOOL_TYPE", "STRING_TYPE", "RUNE_TYPE", "TRUE", "FALSE", "IN", "NOT_KW", 
		    "LPAREN", "RPAREN", "LBRACE", "RBRACE", "LBRACK", "RBRACK", "SEMICOLON", 
		    "COMMA", "COLON", "RANGE", "DOT", "EQUAL", "NOT_EQUAL", "LESS_EQUAL", 
		    "GREATER_EQUAL", "LESS", "GREATER", "ASSIGN", "SHORT_ASSIGN", "PLUS_ASSIGN", 
		    "MINUS_ASSIGN", "MULT_ASSIGN", "DIV_ASSIGN", "INC", "DEC", "AND", 
		    "OR", "BANG", "PLUS", "MINUS", "MULT", "DIV", "MOD", "AMP", "STRING", 
		    "FLOAT_LITERAL", "INT_LITERAL", "RUNE_LITERAL", "IDENTIFIER", "LINE_COMMENT", 
		    "BLOCK_COMMENT", "WS", "ERROR_CHAR"
		];

		private const SERIALIZED_ATN =
			[4, 1, 65, 495, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    2, 29, 7, 29, 2, 30, 7, 30, 2, 31, 7, 31, 2, 32, 7, 32, 2, 33, 7, 
		    33, 2, 34, 7, 34, 2, 35, 7, 35, 2, 36, 7, 36, 2, 37, 7, 37, 2, 38, 
		    7, 38, 2, 39, 7, 39, 2, 40, 7, 40, 2, 41, 7, 41, 2, 42, 7, 42, 2, 
		    43, 7, 43, 2, 44, 7, 44, 2, 45, 7, 45, 2, 46, 7, 46, 2, 47, 7, 47, 
		    2, 48, 7, 48, 2, 49, 7, 49, 2, 50, 7, 50, 2, 51, 7, 51, 2, 52, 7, 
		    52, 1, 0, 5, 0, 108, 8, 0, 10, 0, 12, 0, 111, 9, 0, 1, 0, 1, 0, 1, 
		    1, 1, 1, 1, 1, 1, 1, 3, 1, 119, 8, 1, 1, 1, 1, 1, 3, 1, 123, 8, 1, 
		    1, 1, 1, 1, 1, 2, 1, 2, 1, 2, 5, 2, 130, 8, 2, 10, 2, 12, 2, 133, 
		    9, 2, 1, 3, 1, 3, 1, 3, 1, 4, 1, 4, 1, 4, 1, 4, 1, 4, 5, 4, 143, 8, 
		    4, 10, 4, 12, 4, 146, 9, 4, 1, 4, 1, 4, 3, 4, 150, 8, 4, 1, 5, 1, 
		    5, 5, 5, 154, 8, 5, 10, 5, 12, 5, 157, 9, 5, 1, 5, 1, 5, 1, 6, 1, 
		    6, 3, 6, 163, 8, 6, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 
		    1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 3, 7, 178, 8, 7, 1, 8, 1, 8, 1, 8, 1, 
		    8, 1, 8, 3, 8, 185, 8, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 3, 8, 192, 
		    8, 8, 3, 8, 194, 8, 8, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 10, 
		    1, 10, 1, 10, 1, 10, 1, 11, 1, 11, 1, 11, 1, 11, 1, 12, 1, 12, 1, 
		    12, 3, 12, 213, 8, 12, 1, 13, 1, 13, 1, 14, 1, 14, 1, 14, 5, 14, 220, 
		    8, 14, 10, 14, 12, 14, 223, 9, 14, 1, 15, 1, 15, 1, 15, 5, 15, 228, 
		    8, 15, 10, 15, 12, 15, 231, 9, 15, 1, 16, 1, 16, 1, 16, 3, 16, 236, 
		    8, 16, 1, 17, 1, 17, 1, 18, 1, 18, 1, 18, 1, 19, 4, 19, 244, 8, 19, 
		    11, 19, 12, 19, 245, 1, 19, 1, 19, 1, 20, 1, 20, 1, 20, 1, 20, 1, 
		    21, 1, 21, 1, 21, 3, 21, 257, 8, 21, 1, 21, 1, 21, 1, 22, 1, 22, 1, 
		    22, 5, 22, 264, 8, 22, 10, 22, 12, 22, 267, 9, 22, 1, 22, 3, 22, 270, 
		    8, 22, 1, 23, 1, 23, 1, 23, 3, 23, 275, 8, 23, 1, 23, 3, 23, 278, 
		    8, 23, 1, 24, 1, 24, 4, 24, 282, 8, 24, 11, 24, 12, 24, 283, 1, 25, 
		    1, 25, 1, 25, 1, 25, 1, 26, 4, 26, 291, 8, 26, 11, 26, 12, 26, 292, 
		    1, 26, 1, 26, 1, 27, 1, 27, 1, 27, 3, 27, 300, 8, 27, 1, 27, 1, 27, 
		    1, 28, 1, 28, 1, 28, 3, 28, 307, 8, 28, 1, 29, 1, 29, 1, 30, 1, 30, 
		    1, 30, 1, 30, 1, 30, 1, 30, 1, 31, 1, 31, 1, 32, 1, 32, 1, 32, 5, 
		    32, 322, 8, 32, 10, 32, 12, 32, 325, 9, 32, 1, 33, 1, 33, 1, 33, 5, 
		    33, 330, 8, 33, 10, 33, 12, 33, 333, 9, 33, 1, 34, 1, 34, 1, 34, 5, 
		    34, 338, 8, 34, 10, 34, 12, 34, 341, 9, 34, 1, 35, 1, 35, 1, 35, 5, 
		    35, 346, 8, 35, 10, 35, 12, 35, 349, 9, 35, 1, 35, 1, 35, 1, 35, 1, 
		    35, 1, 35, 1, 35, 1, 35, 1, 35, 1, 35, 3, 35, 360, 8, 35, 1, 36, 1, 
		    36, 1, 36, 5, 36, 365, 8, 36, 10, 36, 12, 36, 368, 9, 36, 1, 37, 1, 
		    37, 1, 37, 5, 37, 373, 8, 37, 10, 37, 12, 37, 376, 9, 37, 1, 38, 1, 
		    38, 1, 38, 1, 38, 1, 38, 1, 38, 1, 38, 1, 38, 1, 38, 3, 38, 387, 8, 
		    38, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 
		    1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 3, 39, 405, 8, 39, 
		    1, 40, 1, 40, 1, 40, 1, 40, 3, 40, 411, 8, 40, 1, 40, 1, 40, 1, 40, 
		    1, 40, 1, 40, 3, 40, 418, 8, 40, 3, 40, 420, 8, 40, 1, 41, 1, 41, 
		    1, 41, 1, 41, 5, 41, 426, 8, 41, 10, 41, 12, 41, 429, 9, 41, 1, 41, 
		    3, 41, 432, 8, 41, 1, 41, 1, 41, 1, 42, 1, 42, 1, 42, 1, 42, 5, 42, 
		    440, 8, 42, 10, 42, 12, 42, 443, 9, 42, 1, 43, 1, 43, 1, 43, 5, 43, 
		    448, 8, 43, 10, 43, 12, 43, 451, 9, 43, 1, 44, 1, 44, 1, 44, 1, 44, 
		    1, 44, 1, 44, 1, 44, 1, 44, 1, 44, 1, 44, 3, 44, 463, 8, 44, 1, 45, 
		    1, 45, 1, 45, 1, 45, 1, 45, 1, 45, 1, 46, 1, 46, 1, 46, 3, 46, 474, 
		    8, 46, 1, 47, 1, 47, 1, 47, 1, 48, 1, 48, 1, 48, 1, 48, 1, 49, 1, 
		    49, 1, 49, 1, 49, 1, 50, 1, 50, 1, 51, 1, 51, 1, 52, 1, 52, 3, 52, 
		    493, 8, 52, 1, 52, 0, 0, 53, 0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 
		    22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50, 52, 54, 
		    56, 58, 60, 62, 64, 66, 68, 70, 72, 74, 76, 78, 80, 82, 84, 86, 88, 
		    90, 92, 94, 96, 98, 100, 102, 104, 0, 7, 2, 0, 40, 40, 42, 45, 1, 
		    0, 14, 18, 1, 0, 34, 35, 1, 0, 36, 39, 1, 0, 51, 52, 1, 0, 53, 55, 
		    1, 0, 46, 47, 516, 0, 109, 1, 0, 0, 0, 2, 114, 1, 0, 0, 0, 4, 126, 
		    1, 0, 0, 0, 6, 134, 1, 0, 0, 0, 8, 149, 1, 0, 0, 0, 10, 151, 1, 0, 
		    0, 0, 12, 160, 1, 0, 0, 0, 14, 177, 1, 0, 0, 0, 16, 193, 1, 0, 0, 
		    0, 18, 195, 1, 0, 0, 0, 20, 201, 1, 0, 0, 0, 22, 205, 1, 0, 0, 0, 
		    24, 212, 1, 0, 0, 0, 26, 214, 1, 0, 0, 0, 28, 216, 1, 0, 0, 0, 30, 
		    224, 1, 0, 0, 0, 32, 235, 1, 0, 0, 0, 34, 237, 1, 0, 0, 0, 36, 239, 
		    1, 0, 0, 0, 38, 243, 1, 0, 0, 0, 40, 249, 1, 0, 0, 0, 42, 253, 1, 
		    0, 0, 0, 44, 260, 1, 0, 0, 0, 46, 277, 1, 0, 0, 0, 48, 279, 1, 0, 
		    0, 0, 50, 285, 1, 0, 0, 0, 52, 290, 1, 0, 0, 0, 54, 296, 1, 0, 0, 
		    0, 56, 303, 1, 0, 0, 0, 58, 308, 1, 0, 0, 0, 60, 310, 1, 0, 0, 0, 
		    62, 316, 1, 0, 0, 0, 64, 318, 1, 0, 0, 0, 66, 326, 1, 0, 0, 0, 68, 
		    334, 1, 0, 0, 0, 70, 359, 1, 0, 0, 0, 72, 361, 1, 0, 0, 0, 74, 369, 
		    1, 0, 0, 0, 76, 386, 1, 0, 0, 0, 78, 404, 1, 0, 0, 0, 80, 406, 1, 
		    0, 0, 0, 82, 421, 1, 0, 0, 0, 84, 435, 1, 0, 0, 0, 86, 444, 1, 0, 
		    0, 0, 88, 462, 1, 0, 0, 0, 90, 464, 1, 0, 0, 0, 92, 473, 1, 0, 0, 
		    0, 94, 475, 1, 0, 0, 0, 96, 478, 1, 0, 0, 0, 98, 482, 1, 0, 0, 0, 
		    100, 486, 1, 0, 0, 0, 102, 488, 1, 0, 0, 0, 104, 490, 1, 0, 0, 0, 
		    106, 108, 3, 2, 1, 0, 107, 106, 1, 0, 0, 0, 108, 111, 1, 0, 0, 0, 
		    109, 107, 1, 0, 0, 0, 109, 110, 1, 0, 0, 0, 110, 112, 1, 0, 0, 0, 
		    111, 109, 1, 0, 0, 0, 112, 113, 5, 0, 0, 1, 113, 1, 1, 0, 0, 0, 114, 
		    115, 5, 1, 0, 0, 115, 116, 5, 61, 0, 0, 116, 118, 5, 23, 0, 0, 117, 
		    119, 3, 4, 2, 0, 118, 117, 1, 0, 0, 0, 118, 119, 1, 0, 0, 0, 119, 
		    120, 1, 0, 0, 0, 120, 122, 5, 24, 0, 0, 121, 123, 3, 8, 4, 0, 122, 
		    121, 1, 0, 0, 0, 122, 123, 1, 0, 0, 0, 123, 124, 1, 0, 0, 0, 124, 
		    125, 3, 10, 5, 0, 125, 3, 1, 0, 0, 0, 126, 131, 3, 6, 3, 0, 127, 128, 
		    5, 30, 0, 0, 128, 130, 3, 6, 3, 0, 129, 127, 1, 0, 0, 0, 130, 133, 
		    1, 0, 0, 0, 131, 129, 1, 0, 0, 0, 131, 132, 1, 0, 0, 0, 132, 5, 1, 
		    0, 0, 0, 133, 131, 1, 0, 0, 0, 134, 135, 5, 61, 0, 0, 135, 136, 3, 
		    32, 16, 0, 136, 7, 1, 0, 0, 0, 137, 150, 3, 32, 16, 0, 138, 139, 5, 
		    23, 0, 0, 139, 144, 3, 32, 16, 0, 140, 141, 5, 30, 0, 0, 141, 143, 
		    3, 32, 16, 0, 142, 140, 1, 0, 0, 0, 143, 146, 1, 0, 0, 0, 144, 142, 
		    1, 0, 0, 0, 144, 145, 1, 0, 0, 0, 145, 147, 1, 0, 0, 0, 146, 144, 
		    1, 0, 0, 0, 147, 148, 5, 24, 0, 0, 148, 150, 1, 0, 0, 0, 149, 137, 
		    1, 0, 0, 0, 149, 138, 1, 0, 0, 0, 150, 9, 1, 0, 0, 0, 151, 155, 5, 
		    25, 0, 0, 152, 154, 3, 12, 6, 0, 153, 152, 1, 0, 0, 0, 154, 157, 1, 
		    0, 0, 0, 155, 153, 1, 0, 0, 0, 155, 156, 1, 0, 0, 0, 156, 158, 1, 
		    0, 0, 0, 157, 155, 1, 0, 0, 0, 158, 159, 5, 26, 0, 0, 159, 11, 1, 
		    0, 0, 0, 160, 162, 3, 14, 7, 0, 161, 163, 5, 29, 0, 0, 162, 161, 1, 
		    0, 0, 0, 162, 163, 1, 0, 0, 0, 163, 13, 1, 0, 0, 0, 164, 178, 3, 54, 
		    27, 0, 165, 178, 3, 16, 8, 0, 166, 178, 3, 18, 9, 0, 167, 178, 3, 
		    20, 10, 0, 168, 178, 3, 22, 11, 0, 169, 178, 3, 94, 47, 0, 170, 178, 
		    3, 80, 40, 0, 171, 178, 3, 82, 41, 0, 172, 178, 3, 88, 44, 0, 173, 
		    178, 3, 100, 50, 0, 174, 178, 3, 102, 51, 0, 175, 178, 3, 104, 52, 
		    0, 176, 178, 3, 62, 31, 0, 177, 164, 1, 0, 0, 0, 177, 165, 1, 0, 0, 
		    0, 177, 166, 1, 0, 0, 0, 177, 167, 1, 0, 0, 0, 177, 168, 1, 0, 0, 
		    0, 177, 169, 1, 0, 0, 0, 177, 170, 1, 0, 0, 0, 177, 171, 1, 0, 0, 
		    0, 177, 172, 1, 0, 0, 0, 177, 173, 1, 0, 0, 0, 177, 174, 1, 0, 0, 
		    0, 177, 175, 1, 0, 0, 0, 177, 176, 1, 0, 0, 0, 178, 15, 1, 0, 0, 0, 
		    179, 180, 5, 2, 0, 0, 180, 181, 3, 28, 14, 0, 181, 184, 3, 32, 16, 
		    0, 182, 183, 5, 40, 0, 0, 183, 185, 3, 30, 15, 0, 184, 182, 1, 0, 
		    0, 0, 184, 185, 1, 0, 0, 0, 185, 194, 1, 0, 0, 0, 186, 187, 5, 2, 
		    0, 0, 187, 188, 5, 61, 0, 0, 188, 191, 3, 38, 19, 0, 189, 190, 5, 
		    40, 0, 0, 190, 192, 3, 42, 21, 0, 191, 189, 1, 0, 0, 0, 191, 192, 
		    1, 0, 0, 0, 192, 194, 1, 0, 0, 0, 193, 179, 1, 0, 0, 0, 193, 186, 
		    1, 0, 0, 0, 194, 17, 1, 0, 0, 0, 195, 196, 5, 3, 0, 0, 196, 197, 5, 
		    61, 0, 0, 197, 198, 3, 32, 16, 0, 198, 199, 5, 40, 0, 0, 199, 200, 
		    3, 62, 31, 0, 200, 19, 1, 0, 0, 0, 201, 202, 3, 28, 14, 0, 202, 203, 
		    5, 41, 0, 0, 203, 204, 3, 30, 15, 0, 204, 21, 1, 0, 0, 0, 205, 206, 
		    3, 24, 12, 0, 206, 207, 3, 26, 13, 0, 207, 208, 3, 30, 15, 0, 208, 
		    23, 1, 0, 0, 0, 209, 213, 3, 28, 14, 0, 210, 213, 3, 48, 24, 0, 211, 
		    213, 3, 52, 26, 0, 212, 209, 1, 0, 0, 0, 212, 210, 1, 0, 0, 0, 212, 
		    211, 1, 0, 0, 0, 213, 25, 1, 0, 0, 0, 214, 215, 7, 0, 0, 0, 215, 27, 
		    1, 0, 0, 0, 216, 221, 5, 61, 0, 0, 217, 218, 5, 30, 0, 0, 218, 220, 
		    5, 61, 0, 0, 219, 217, 1, 0, 0, 0, 220, 223, 1, 0, 0, 0, 221, 219, 
		    1, 0, 0, 0, 221, 222, 1, 0, 0, 0, 222, 29, 1, 0, 0, 0, 223, 221, 1, 
		    0, 0, 0, 224, 229, 3, 62, 31, 0, 225, 226, 5, 30, 0, 0, 226, 228, 
		    3, 62, 31, 0, 227, 225, 1, 0, 0, 0, 228, 231, 1, 0, 0, 0, 229, 227, 
		    1, 0, 0, 0, 229, 230, 1, 0, 0, 0, 230, 31, 1, 0, 0, 0, 231, 229, 1, 
		    0, 0, 0, 232, 236, 3, 34, 17, 0, 233, 236, 3, 38, 19, 0, 234, 236, 
		    3, 36, 18, 0, 235, 232, 1, 0, 0, 0, 235, 233, 1, 0, 0, 0, 235, 234, 
		    1, 0, 0, 0, 236, 33, 1, 0, 0, 0, 237, 238, 7, 1, 0, 0, 238, 35, 1, 
		    0, 0, 0, 239, 240, 5, 53, 0, 0, 240, 241, 3, 32, 16, 0, 241, 37, 1, 
		    0, 0, 0, 242, 244, 3, 40, 20, 0, 243, 242, 1, 0, 0, 0, 244, 245, 1, 
		    0, 0, 0, 245, 243, 1, 0, 0, 0, 245, 246, 1, 0, 0, 0, 246, 247, 1, 
		    0, 0, 0, 247, 248, 3, 34, 17, 0, 248, 39, 1, 0, 0, 0, 249, 250, 5, 
		    27, 0, 0, 250, 251, 5, 59, 0, 0, 251, 252, 5, 28, 0, 0, 252, 41, 1, 
		    0, 0, 0, 253, 254, 3, 38, 19, 0, 254, 256, 5, 25, 0, 0, 255, 257, 
		    3, 44, 22, 0, 256, 255, 1, 0, 0, 0, 256, 257, 1, 0, 0, 0, 257, 258, 
		    1, 0, 0, 0, 258, 259, 5, 26, 0, 0, 259, 43, 1, 0, 0, 0, 260, 265, 
		    3, 46, 23, 0, 261, 262, 5, 30, 0, 0, 262, 264, 3, 46, 23, 0, 263, 
		    261, 1, 0, 0, 0, 264, 267, 1, 0, 0, 0, 265, 263, 1, 0, 0, 0, 265, 
		    266, 1, 0, 0, 0, 266, 269, 1, 0, 0, 0, 267, 265, 1, 0, 0, 0, 268, 
		    270, 5, 30, 0, 0, 269, 268, 1, 0, 0, 0, 269, 270, 1, 0, 0, 0, 270, 
		    45, 1, 0, 0, 0, 271, 278, 3, 62, 31, 0, 272, 274, 5, 25, 0, 0, 273, 
		    275, 3, 44, 22, 0, 274, 273, 1, 0, 0, 0, 274, 275, 1, 0, 0, 0, 275, 
		    276, 1, 0, 0, 0, 276, 278, 5, 26, 0, 0, 277, 271, 1, 0, 0, 0, 277, 
		    272, 1, 0, 0, 0, 278, 47, 1, 0, 0, 0, 279, 281, 5, 61, 0, 0, 280, 
		    282, 3, 50, 25, 0, 281, 280, 1, 0, 0, 0, 282, 283, 1, 0, 0, 0, 283, 
		    281, 1, 0, 0, 0, 283, 284, 1, 0, 0, 0, 284, 49, 1, 0, 0, 0, 285, 286, 
		    5, 27, 0, 0, 286, 287, 3, 62, 31, 0, 287, 288, 5, 28, 0, 0, 288, 51, 
		    1, 0, 0, 0, 289, 291, 5, 53, 0, 0, 290, 289, 1, 0, 0, 0, 291, 292, 
		    1, 0, 0, 0, 292, 290, 1, 0, 0, 0, 292, 293, 1, 0, 0, 0, 293, 294, 
		    1, 0, 0, 0, 294, 295, 5, 61, 0, 0, 295, 53, 1, 0, 0, 0, 296, 297, 
		    3, 56, 28, 0, 297, 299, 5, 23, 0, 0, 298, 300, 3, 58, 29, 0, 299, 
		    298, 1, 0, 0, 0, 299, 300, 1, 0, 0, 0, 300, 301, 1, 0, 0, 0, 301, 
		    302, 5, 24, 0, 0, 302, 55, 1, 0, 0, 0, 303, 306, 5, 61, 0, 0, 304, 
		    305, 5, 33, 0, 0, 305, 307, 5, 61, 0, 0, 306, 304, 1, 0, 0, 0, 306, 
		    307, 1, 0, 0, 0, 307, 57, 1, 0, 0, 0, 308, 309, 3, 30, 15, 0, 309, 
		    59, 1, 0, 0, 0, 310, 311, 5, 27, 0, 0, 311, 312, 3, 62, 31, 0, 312, 
		    313, 5, 32, 0, 0, 313, 314, 3, 62, 31, 0, 314, 315, 5, 28, 0, 0, 315, 
		    61, 1, 0, 0, 0, 316, 317, 3, 64, 32, 0, 317, 63, 1, 0, 0, 0, 318, 
		    323, 3, 66, 33, 0, 319, 320, 5, 49, 0, 0, 320, 322, 3, 66, 33, 0, 
		    321, 319, 1, 0, 0, 0, 322, 325, 1, 0, 0, 0, 323, 321, 1, 0, 0, 0, 
		    323, 324, 1, 0, 0, 0, 324, 65, 1, 0, 0, 0, 325, 323, 1, 0, 0, 0, 326, 
		    331, 3, 68, 34, 0, 327, 328, 5, 48, 0, 0, 328, 330, 3, 68, 34, 0, 
		    329, 327, 1, 0, 0, 0, 330, 333, 1, 0, 0, 0, 331, 329, 1, 0, 0, 0, 
		    331, 332, 1, 0, 0, 0, 332, 67, 1, 0, 0, 0, 333, 331, 1, 0, 0, 0, 334, 
		    339, 3, 70, 35, 0, 335, 336, 7, 2, 0, 0, 336, 338, 3, 70, 35, 0, 337, 
		    335, 1, 0, 0, 0, 338, 341, 1, 0, 0, 0, 339, 337, 1, 0, 0, 0, 339, 
		    340, 1, 0, 0, 0, 340, 69, 1, 0, 0, 0, 341, 339, 1, 0, 0, 0, 342, 347, 
		    3, 72, 36, 0, 343, 344, 7, 3, 0, 0, 344, 346, 3, 72, 36, 0, 345, 343, 
		    1, 0, 0, 0, 346, 349, 1, 0, 0, 0, 347, 345, 1, 0, 0, 0, 347, 348, 
		    1, 0, 0, 0, 348, 360, 1, 0, 0, 0, 349, 347, 1, 0, 0, 0, 350, 351, 
		    3, 72, 36, 0, 351, 352, 5, 21, 0, 0, 352, 353, 3, 60, 30, 0, 353, 
		    360, 1, 0, 0, 0, 354, 355, 3, 72, 36, 0, 355, 356, 5, 22, 0, 0, 356, 
		    357, 5, 21, 0, 0, 357, 358, 3, 60, 30, 0, 358, 360, 1, 0, 0, 0, 359, 
		    342, 1, 0, 0, 0, 359, 350, 1, 0, 0, 0, 359, 354, 1, 0, 0, 0, 360, 
		    71, 1, 0, 0, 0, 361, 366, 3, 74, 37, 0, 362, 363, 7, 4, 0, 0, 363, 
		    365, 3, 74, 37, 0, 364, 362, 1, 0, 0, 0, 365, 368, 1, 0, 0, 0, 366, 
		    364, 1, 0, 0, 0, 366, 367, 1, 0, 0, 0, 367, 73, 1, 0, 0, 0, 368, 366, 
		    1, 0, 0, 0, 369, 374, 3, 76, 38, 0, 370, 371, 7, 5, 0, 0, 371, 373, 
		    3, 76, 38, 0, 372, 370, 1, 0, 0, 0, 373, 376, 1, 0, 0, 0, 374, 372, 
		    1, 0, 0, 0, 374, 375, 1, 0, 0, 0, 375, 75, 1, 0, 0, 0, 376, 374, 1, 
		    0, 0, 0, 377, 378, 5, 50, 0, 0, 378, 387, 3, 76, 38, 0, 379, 380, 
		    5, 52, 0, 0, 380, 387, 3, 76, 38, 0, 381, 382, 5, 53, 0, 0, 382, 387, 
		    3, 76, 38, 0, 383, 384, 5, 56, 0, 0, 384, 387, 3, 76, 38, 0, 385, 
		    387, 3, 78, 39, 0, 386, 377, 1, 0, 0, 0, 386, 379, 1, 0, 0, 0, 386, 
		    381, 1, 0, 0, 0, 386, 383, 1, 0, 0, 0, 386, 385, 1, 0, 0, 0, 387, 
		    77, 1, 0, 0, 0, 388, 405, 3, 54, 27, 0, 389, 405, 3, 48, 24, 0, 390, 
		    405, 3, 52, 26, 0, 391, 405, 3, 42, 21, 0, 392, 405, 5, 59, 0, 0, 
		    393, 405, 5, 58, 0, 0, 394, 405, 5, 57, 0, 0, 395, 405, 5, 60, 0, 
		    0, 396, 405, 5, 19, 0, 0, 397, 405, 5, 20, 0, 0, 398, 405, 5, 4, 0, 
		    0, 399, 405, 5, 61, 0, 0, 400, 401, 5, 23, 0, 0, 401, 402, 3, 62, 
		    31, 0, 402, 403, 5, 24, 0, 0, 403, 405, 1, 0, 0, 0, 404, 388, 1, 0, 
		    0, 0, 404, 389, 1, 0, 0, 0, 404, 390, 1, 0, 0, 0, 404, 391, 1, 0, 
		    0, 0, 404, 392, 1, 0, 0, 0, 404, 393, 1, 0, 0, 0, 404, 394, 1, 0, 
		    0, 0, 404, 395, 1, 0, 0, 0, 404, 396, 1, 0, 0, 0, 404, 397, 1, 0, 
		    0, 0, 404, 398, 1, 0, 0, 0, 404, 399, 1, 0, 0, 0, 404, 400, 1, 0, 
		    0, 0, 405, 79, 1, 0, 0, 0, 406, 410, 5, 5, 0, 0, 407, 408, 3, 92, 
		    46, 0, 408, 409, 5, 29, 0, 0, 409, 411, 1, 0, 0, 0, 410, 407, 1, 0, 
		    0, 0, 410, 411, 1, 0, 0, 0, 411, 412, 1, 0, 0, 0, 412, 413, 3, 62, 
		    31, 0, 413, 419, 3, 10, 5, 0, 414, 417, 5, 6, 0, 0, 415, 418, 3, 80, 
		    40, 0, 416, 418, 3, 10, 5, 0, 417, 415, 1, 0, 0, 0, 417, 416, 1, 0, 
		    0, 0, 418, 420, 1, 0, 0, 0, 419, 414, 1, 0, 0, 0, 419, 420, 1, 0, 
		    0, 0, 420, 81, 1, 0, 0, 0, 421, 422, 5, 7, 0, 0, 422, 423, 3, 62, 
		    31, 0, 423, 427, 5, 25, 0, 0, 424, 426, 3, 84, 42, 0, 425, 424, 1, 
		    0, 0, 0, 426, 429, 1, 0, 0, 0, 427, 425, 1, 0, 0, 0, 427, 428, 1, 
		    0, 0, 0, 428, 431, 1, 0, 0, 0, 429, 427, 1, 0, 0, 0, 430, 432, 3, 
		    86, 43, 0, 431, 430, 1, 0, 0, 0, 431, 432, 1, 0, 0, 0, 432, 433, 1, 
		    0, 0, 0, 433, 434, 5, 26, 0, 0, 434, 83, 1, 0, 0, 0, 435, 436, 5, 
		    8, 0, 0, 436, 437, 3, 30, 15, 0, 437, 441, 5, 31, 0, 0, 438, 440, 
		    3, 12, 6, 0, 439, 438, 1, 0, 0, 0, 440, 443, 1, 0, 0, 0, 441, 439, 
		    1, 0, 0, 0, 441, 442, 1, 0, 0, 0, 442, 85, 1, 0, 0, 0, 443, 441, 1, 
		    0, 0, 0, 444, 445, 5, 9, 0, 0, 445, 449, 5, 31, 0, 0, 446, 448, 3, 
		    12, 6, 0, 447, 446, 1, 0, 0, 0, 448, 451, 1, 0, 0, 0, 449, 447, 1, 
		    0, 0, 0, 449, 450, 1, 0, 0, 0, 450, 87, 1, 0, 0, 0, 451, 449, 1, 0, 
		    0, 0, 452, 453, 5, 10, 0, 0, 453, 454, 3, 90, 45, 0, 454, 455, 3, 
		    10, 5, 0, 455, 463, 1, 0, 0, 0, 456, 457, 5, 10, 0, 0, 457, 458, 3, 
		    62, 31, 0, 458, 459, 3, 10, 5, 0, 459, 463, 1, 0, 0, 0, 460, 461, 
		    5, 10, 0, 0, 461, 463, 3, 10, 5, 0, 462, 452, 1, 0, 0, 0, 462, 456, 
		    1, 0, 0, 0, 462, 460, 1, 0, 0, 0, 463, 89, 1, 0, 0, 0, 464, 465, 3, 
		    92, 46, 0, 465, 466, 5, 29, 0, 0, 466, 467, 3, 62, 31, 0, 467, 468, 
		    5, 29, 0, 0, 468, 469, 3, 92, 46, 0, 469, 91, 1, 0, 0, 0, 470, 474, 
		    3, 96, 48, 0, 471, 474, 3, 98, 49, 0, 472, 474, 3, 94, 47, 0, 473, 
		    470, 1, 0, 0, 0, 473, 471, 1, 0, 0, 0, 473, 472, 1, 0, 0, 0, 474, 
		    93, 1, 0, 0, 0, 475, 476, 5, 61, 0, 0, 476, 477, 7, 6, 0, 0, 477, 
		    95, 1, 0, 0, 0, 478, 479, 3, 28, 14, 0, 479, 480, 5, 41, 0, 0, 480, 
		    481, 3, 30, 15, 0, 481, 97, 1, 0, 0, 0, 482, 483, 3, 24, 12, 0, 483, 
		    484, 3, 26, 13, 0, 484, 485, 3, 30, 15, 0, 485, 99, 1, 0, 0, 0, 486, 
		    487, 5, 11, 0, 0, 487, 101, 1, 0, 0, 0, 488, 489, 5, 12, 0, 0, 489, 
		    103, 1, 0, 0, 0, 490, 492, 5, 13, 0, 0, 491, 493, 3, 30, 15, 0, 492, 
		    491, 1, 0, 0, 0, 492, 493, 1, 0, 0, 0, 493, 105, 1, 0, 0, 0, 45, 109, 
		    118, 122, 131, 144, 149, 155, 162, 177, 184, 191, 193, 212, 221, 229, 
		    235, 245, 256, 265, 269, 274, 277, 283, 292, 299, 306, 323, 331, 339, 
		    347, 359, 366, 374, 386, 404, 410, 417, 419, 427, 431, 441, 449, 462, 
		    473, 492];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.2', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "GolampiArm.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function program(): Context\ProgramContext
		{
		    $localContext = new Context\ProgramContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_program);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(109);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::FUNC) {
		        	$this->setState(106);
		        	$this->functionDecl();
		        	$this->setState(111);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(112);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functionDecl(): Context\FunctionDeclContext
		{
		    $localContext = new Context\FunctionDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_functionDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(114);
		        $this->match(self::FUNC);
		        $this->setState(115);
		        $this->match(self::IDENTIFIER);
		        $this->setState(116);
		        $this->match(self::LPAREN);
		        $this->setState(118);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::IDENTIFIER) {
		        	$this->setState(117);
		        	$this->params();
		        }
		        $this->setState(120);
		        $this->match(self::RPAREN);
		        $this->setState(122);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9007199397855232) !== 0)) {
		        	$this->setState(121);
		        	$this->returnTypes();
		        }
		        $this->setState(124);
		        $this->block();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function params(): Context\ParamsContext
		{
		    $localContext = new Context\ParamsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_params);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(126);
		        $this->param();
		        $this->setState(131);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(127);
		        	$this->match(self::COMMA);
		        	$this->setState(128);
		        	$this->param();
		        	$this->setState(133);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function param(): Context\ParamContext
		{
		    $localContext = new Context\ParamContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_param);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(134);
		        $this->match(self::IDENTIFIER);
		        $this->setState(135);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnTypes(): Context\ReturnTypesContext
		{
		    $localContext = new Context\ReturnTypesContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_returnTypes);

		    try {
		        $this->setState(149);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT_TYPE:
		            case self::FLOAT_TYPE:
		            case self::BOOL_TYPE:
		            case self::STRING_TYPE:
		            case self::RUNE_TYPE:
		            case self::LBRACK:
		            case self::MULT:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(137);
		            	$this->type();
		            	break;

		            case self::LPAREN:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(138);
		            	$this->match(self::LPAREN);
		            	$this->setState(139);
		            	$this->type();
		            	$this->setState(144);
		            	$this->errorHandler->sync($this);

		            	$_la = $this->input->LA(1);
		            	while ($_la === self::COMMA) {
		            		$this->setState(140);
		            		$this->match(self::COMMA);
		            		$this->setState(141);
		            		$this->type();
		            		$this->setState(146);
		            		$this->errorHandler->sync($this);
		            		$_la = $this->input->LA(1);
		            	}
		            	$this->setState(147);
		            	$this->match(self::RPAREN);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function block(): Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(151);
		        $this->match(self::LBRACE);
		        $this->setState(155);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4554265123322608828) !== 0)) {
		        	$this->setState(152);
		        	$this->statement();
		        	$this->setState(157);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(158);
		        $this->match(self::RBRACE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function statement(): Context\StatementContext
		{
		    $localContext = new Context\StatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_statement);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(160);
		        $this->statementCore();
		        $this->setState(162);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::SEMICOLON) {
		        	$this->setState(161);
		        	$this->match(self::SEMICOLON);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function statementCore(): Context\StatementCoreContext
		{
		    $localContext = new Context\StatementCoreContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_statementCore);

		    try {
		        $this->setState(177);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 8, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(164);
		        	    $this->functionCall();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(165);
		        	    $this->varDecl();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(166);
		        	    $this->constDecl();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(167);
		        	    $this->shortVarDecl();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(168);
		        	    $this->assignment();
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(169);
		        	    $this->incDecStmt();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(170);
		        	    $this->ifStmt();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(171);
		        	    $this->switchStmt();
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(172);
		        	    $this->forStmt();
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(173);
		        	    $this->breakStmt();
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(174);
		        	    $this->continueStmt();
		        	break;

		        	case 12:
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(175);
		        	    $this->returnStmt();
		        	break;

		        	case 13:
		        	    $this->enterOuterAlt($localContext, 13);
		        	    $this->setState(176);
		        	    $this->expression();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varDecl(): Context\VarDeclContext
		{
		    $localContext = new Context\VarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_varDecl);

		    try {
		        $this->setState(193);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 11, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(179);
		        	    $this->match(self::VAR);
		        	    $this->setState(180);
		        	    $this->idList();
		        	    $this->setState(181);
		        	    $this->type();
		        	    $this->setState(184);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::ASSIGN) {
		        	    	$this->setState(182);
		        	    	$this->match(self::ASSIGN);
		        	    	$this->setState(183);
		        	    	$this->expList();
		        	    }
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(186);
		        	    $this->match(self::VAR);
		        	    $this->setState(187);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(188);
		        	    $this->arrayType();
		        	    $this->setState(191);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::ASSIGN) {
		        	    	$this->setState(189);
		        	    	$this->match(self::ASSIGN);
		        	    	$this->setState(190);
		        	    	$this->arrayLiteral();
		        	    }
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function constDecl(): Context\ConstDeclContext
		{
		    $localContext = new Context\ConstDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_constDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(195);
		        $this->match(self::CONST);
		        $this->setState(196);
		        $this->match(self::IDENTIFIER);
		        $this->setState(197);
		        $this->type();
		        $this->setState(198);
		        $this->match(self::ASSIGN);
		        $this->setState(199);
		        $this->expression();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function shortVarDecl(): Context\ShortVarDeclContext
		{
		    $localContext = new Context\ShortVarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_shortVarDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(201);
		        $this->idList();
		        $this->setState(202);
		        $this->match(self::SHORT_ASSIGN);
		        $this->setState(203);
		        $this->expList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignment(): Context\AssignmentContext
		{
		    $localContext = new Context\AssignmentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_assignment);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(205);
		        $this->assignTarget();
		        $this->setState(206);
		        $this->assignOp();
		        $this->setState(207);
		        $this->expList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignTarget(): Context\AssignTargetContext
		{
		    $localContext = new Context\AssignTargetContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_assignTarget);

		    try {
		        $this->setState(212);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 12, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(209);
		        	    $this->idList();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(210);
		        	    $this->arrayAccess();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(211);
		        	    $this->pointerAccess();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignOp(): Context\AssignOpContext
		{
		    $localContext = new Context\AssignOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_assignOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(214);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 67070209294336) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function idList(): Context\IdListContext
		{
		    $localContext = new Context\IdListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_idList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(216);
		        $this->match(self::IDENTIFIER);
		        $this->setState(221);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(217);
		        	$this->match(self::COMMA);
		        	$this->setState(218);
		        	$this->match(self::IDENTIFIER);
		        	$this->setState(223);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expList(): Context\ExpListContext
		{
		    $localContext = new Context\ExpListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_expList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(224);
		        $this->expression();
		        $this->setState(229);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(225);
		        	$this->match(self::COMMA);
		        	$this->setState(226);
		        	$this->expression();
		        	$this->setState(231);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function type(): Context\TypeContext
		{
		    $localContext = new Context\TypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_type);

		    try {
		        $this->setState(235);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT_TYPE:
		            case self::FLOAT_TYPE:
		            case self::BOOL_TYPE:
		            case self::STRING_TYPE:
		            case self::RUNE_TYPE:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(232);
		            	$this->baseType();
		            	break;

		            case self::LBRACK:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(233);
		            	$this->arrayType();
		            	break;

		            case self::MULT:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(234);
		            	$this->pointerType();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function baseType(): Context\BaseTypeContext
		{
		    $localContext = new Context\BaseTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_baseType);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(237);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 507904) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function pointerType(): Context\PointerTypeContext
		{
		    $localContext = new Context\PointerTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_pointerType);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(239);
		        $this->match(self::MULT);
		        $this->setState(240);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayType(): Context\ArrayTypeContext
		{
		    $localContext = new Context\ArrayTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_arrayType);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(243); 
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        do {
		        	$this->setState(242);
		        	$this->arrayDimension();
		        	$this->setState(245); 
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        } while ($_la === self::LBRACK);
		        $this->setState(247);
		        $this->baseType();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayDimension(): Context\ArrayDimensionContext
		{
		    $localContext = new Context\ArrayDimensionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_arrayDimension);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(249);
		        $this->match(self::LBRACK);
		        $this->setState(250);
		        $this->match(self::INT_LITERAL);
		        $this->setState(251);
		        $this->match(self::RBRACK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayLiteral(): Context\ArrayLiteralContext
		{
		    $localContext = new Context\ArrayLiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_arrayLiteral);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(253);
		        $this->arrayType();
		        $this->setState(254);
		        $this->match(self::LBRACE);
		        $this->setState(256);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4554265123356147728) !== 0)) {
		        	$this->setState(255);
		        	$this->arrayElements();
		        }
		        $this->setState(258);
		        $this->match(self::RBRACE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayElements(): Context\ArrayElementsContext
		{
		    $localContext = new Context\ArrayElementsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_arrayElements);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(260);
		        $this->arrayElement();
		        $this->setState(265);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 18, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(261);
		        		$this->match(self::COMMA);
		        		$this->setState(262);
		        		$this->arrayElement(); 
		        	}

		        	$this->setState(267);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 18, $this->ctx);
		        }
		        $this->setState(269);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::COMMA) {
		        	$this->setState(268);
		        	$this->match(self::COMMA);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayElement(): Context\ArrayElementContext
		{
		    $localContext = new Context\ArrayElementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_arrayElement);

		    try {
		        $this->setState(277);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::NIL:
		            case self::TRUE:
		            case self::FALSE:
		            case self::LPAREN:
		            case self::LBRACK:
		            case self::BANG:
		            case self::MINUS:
		            case self::MULT:
		            case self::AMP:
		            case self::STRING:
		            case self::FLOAT_LITERAL:
		            case self::INT_LITERAL:
		            case self::RUNE_LITERAL:
		            case self::IDENTIFIER:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(271);
		            	$this->expression();
		            	break;

		            case self::LBRACE:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(272);
		            	$this->match(self::LBRACE);
		            	$this->setState(274);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4554265123356147728) !== 0)) {
		            		$this->setState(273);
		            		$this->arrayElements();
		            	}
		            	$this->setState(276);
		            	$this->match(self::RBRACE);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayAccess(): Context\ArrayAccessContext
		{
		    $localContext = new Context\ArrayAccessContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 48, self::RULE_arrayAccess);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(279);
		        $this->match(self::IDENTIFIER);
		        $this->setState(281); 
		        $this->errorHandler->sync($this);

		        $alt = 1;

		        do {
		        	switch ($alt) {
		        	case 1:
		        		$this->setState(280);
		        		$this->arrayIndex();
		        		break;
		        	default:
		        		throw new NoViableAltException($this);
		        	}

		        	$this->setState(283); 
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 22, $this->ctx);
		        } while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayIndex(): Context\ArrayIndexContext
		{
		    $localContext = new Context\ArrayIndexContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_arrayIndex);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(285);
		        $this->match(self::LBRACK);
		        $this->setState(286);
		        $this->expression();
		        $this->setState(287);
		        $this->match(self::RBRACK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function pointerAccess(): Context\PointerAccessContext
		{
		    $localContext = new Context\PointerAccessContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_pointerAccess);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(290); 
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        do {
		        	$this->setState(289);
		        	$this->match(self::MULT);
		        	$this->setState(292); 
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        } while ($_la === self::MULT);
		        $this->setState(294);
		        $this->match(self::IDENTIFIER);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functionCall(): Context\FunctionCallContext
		{
		    $localContext = new Context\FunctionCallContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 54, self::RULE_functionCall);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(296);
		        $this->functionName();
		        $this->setState(297);
		        $this->match(self::LPAREN);
		        $this->setState(299);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4554265123322593296) !== 0)) {
		        	$this->setState(298);
		        	$this->args();
		        }
		        $this->setState(301);
		        $this->match(self::RPAREN);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functionName(): Context\FunctionNameContext
		{
		    $localContext = new Context\FunctionNameContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_functionName);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(303);
		        $this->match(self::IDENTIFIER);
		        $this->setState(306);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DOT) {
		        	$this->setState(304);
		        	$this->match(self::DOT);
		        	$this->setState(305);
		        	$this->match(self::IDENTIFIER);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function args(): Context\ArgsContext
		{
		    $localContext = new Context\ArgsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 58, self::RULE_args);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(308);
		        $this->expList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function rangeExp(): Context\RangeExpContext
		{
		    $localContext = new Context\RangeExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_rangeExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(310);
		        $this->match(self::LBRACK);
		        $this->setState(311);
		        $this->expression();
		        $this->setState(312);
		        $this->match(self::RANGE);
		        $this->setState(313);
		        $this->expression();
		        $this->setState(314);
		        $this->match(self::RBRACK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expression(): Context\ExpressionContext
		{
		    $localContext = new Context\ExpressionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 62, self::RULE_expression);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(316);
		        $this->logicalOrExp();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function logicalOrExp(): Context\LogicalOrExpContext
		{
		    $localContext = new Context\LogicalOrExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 64, self::RULE_logicalOrExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(318);
		        $this->logicalAndExp();
		        $this->setState(323);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::OR) {
		        	$this->setState(319);
		        	$this->match(self::OR);
		        	$this->setState(320);
		        	$this->logicalAndExp();
		        	$this->setState(325);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function logicalAndExp(): Context\LogicalAndExpContext
		{
		    $localContext = new Context\LogicalAndExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 66, self::RULE_logicalAndExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(326);
		        $this->equalityExp();
		        $this->setState(331);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::AND) {
		        	$this->setState(327);
		        	$this->match(self::AND);
		        	$this->setState(328);
		        	$this->equalityExp();
		        	$this->setState(333);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function equalityExp(): Context\EqualityExpContext
		{
		    $localContext = new Context\EqualityExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 68, self::RULE_equalityExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(334);
		        $this->relationalExp();
		        $this->setState(339);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::EQUAL || $_la === self::NOT_EQUAL) {
		        	$this->setState(335);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::EQUAL || $_la === self::NOT_EQUAL)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(336);
		        	$this->relationalExp();
		        	$this->setState(341);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function relationalExp(): Context\RelationalExpContext
		{
		    $localContext = new Context\RelationalExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 70, self::RULE_relationalExp);

		    try {
		        $this->setState(359);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 30, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(342);
		        	    $this->additiveExp();
		        	    $this->setState(347);
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1030792151040) !== 0)) {
		        	    	$this->setState(343);

		        	    	$_la = $this->input->LA(1);

		        	    	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1030792151040) !== 0))) {
		        	    	$this->errorHandler->recoverInline($this);
		        	    	} else {
		        	    		if ($this->input->LA(1) === Token::EOF) {
		        	    		    $this->matchedEOF = true;
		        	    	    }

		        	    		$this->errorHandler->reportMatch($this);
		        	    		$this->consume();
		        	    	}
		        	    	$this->setState(344);
		        	    	$this->additiveExp();
		        	    	$this->setState(349);
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    }
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(350);
		        	    $this->additiveExp();
		        	    $this->setState(351);
		        	    $this->match(self::IN);
		        	    $this->setState(352);
		        	    $this->rangeExp();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(354);
		        	    $this->additiveExp();
		        	    $this->setState(355);
		        	    $this->match(self::NOT_KW);
		        	    $this->setState(356);
		        	    $this->match(self::IN);
		        	    $this->setState(357);
		        	    $this->rangeExp();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function additiveExp(): Context\AdditiveExpContext
		{
		    $localContext = new Context\AdditiveExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 72, self::RULE_additiveExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(361);
		        $this->multiplicativeExp();
		        $this->setState(366);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 31, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(362);

		        		$_la = $this->input->LA(1);

		        		if (!($_la === self::PLUS || $_la === self::MINUS)) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(363);
		        		$this->multiplicativeExp(); 
		        	}

		        	$this->setState(368);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 31, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function multiplicativeExp(): Context\MultiplicativeExpContext
		{
		    $localContext = new Context\MultiplicativeExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 74, self::RULE_multiplicativeExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(369);
		        $this->unaryExp();
		        $this->setState(374);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 32, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(370);

		        		$_la = $this->input->LA(1);

		        		if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 63050394783186944) !== 0))) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(371);
		        		$this->unaryExp(); 
		        	}

		        	$this->setState(376);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 32, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function unaryExp(): Context\UnaryExpContext
		{
		    $localContext = new Context\UnaryExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 76, self::RULE_unaryExp);

		    try {
		        $this->setState(386);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 33, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(377);
		        	    $this->match(self::BANG);
		        	    $this->setState(378);
		        	    $this->unaryExp();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(379);
		        	    $this->match(self::MINUS);
		        	    $this->setState(380);
		        	    $this->unaryExp();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(381);
		        	    $this->match(self::MULT);
		        	    $this->setState(382);
		        	    $this->unaryExp();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(383);
		        	    $this->match(self::AMP);
		        	    $this->setState(384);
		        	    $this->unaryExp();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(385);
		        	    $this->primary();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function primary(): Context\PrimaryContext
		{
		    $localContext = new Context\PrimaryContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 78, self::RULE_primary);

		    try {
		        $this->setState(404);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 34, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(388);
		        	    $this->functionCall();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(389);
		        	    $this->arrayAccess();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(390);
		        	    $this->pointerAccess();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(391);
		        	    $this->arrayLiteral();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(392);
		        	    $this->match(self::INT_LITERAL);
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(393);
		        	    $this->match(self::FLOAT_LITERAL);
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(394);
		        	    $this->match(self::STRING);
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(395);
		        	    $this->match(self::RUNE_LITERAL);
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(396);
		        	    $this->match(self::TRUE);
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(397);
		        	    $this->match(self::FALSE);
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(398);
		        	    $this->match(self::NIL);
		        	break;

		        	case 12:
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(399);
		        	    $this->match(self::IDENTIFIER);
		        	break;

		        	case 13:
		        	    $this->enterOuterAlt($localContext, 13);
		        	    $this->setState(400);
		        	    $this->match(self::LPAREN);
		        	    $this->setState(401);
		        	    $this->expression();
		        	    $this->setState(402);
		        	    $this->match(self::RPAREN);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ifStmt(): Context\IfStmtContext
		{
		    $localContext = new Context\IfStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 80, self::RULE_ifStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(406);
		        $this->match(self::IF);
		        $this->setState(410);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx)) {
		            case 1:
		        	    $this->setState(407);
		        	    $this->simpleStmt();
		        	    $this->setState(408);
		        	    $this->match(self::SEMICOLON);
		        	break;
		        }
		        $this->setState(412);
		        $this->expression();
		        $this->setState(413);
		        $this->block();
		        $this->setState(419);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ELSE) {
		        	$this->setState(414);
		        	$this->match(self::ELSE);
		        	$this->setState(417);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::IF:
		        	    	$this->setState(415);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::LBRACE:
		        	    	$this->setState(416);
		        	    	$this->block();
		        	    	break;

		        	default:
		        		throw new NoViableAltException($this);
		        	}
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchStmt(): Context\SwitchStmtContext
		{
		    $localContext = new Context\SwitchStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 82, self::RULE_switchStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(421);
		        $this->match(self::SWITCH);
		        $this->setState(422);
		        $this->expression();
		        $this->setState(423);
		        $this->match(self::LBRACE);
		        $this->setState(427);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::CASE) {
		        	$this->setState(424);
		        	$this->caseClause();
		        	$this->setState(429);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(431);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DEFAULT) {
		        	$this->setState(430);
		        	$this->defaultClause();
		        }
		        $this->setState(433);
		        $this->match(self::RBRACE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function caseClause(): Context\CaseClauseContext
		{
		    $localContext = new Context\CaseClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 84, self::RULE_caseClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(435);
		        $this->match(self::CASE);
		        $this->setState(436);
		        $this->expList();
		        $this->setState(437);
		        $this->match(self::COLON);
		        $this->setState(441);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4554265123322608828) !== 0)) {
		        	$this->setState(438);
		        	$this->statement();
		        	$this->setState(443);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function defaultClause(): Context\DefaultClauseContext
		{
		    $localContext = new Context\DefaultClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 86, self::RULE_defaultClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(444);
		        $this->match(self::DEFAULT);
		        $this->setState(445);
		        $this->match(self::COLON);
		        $this->setState(449);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4554265123322608828) !== 0)) {
		        	$this->setState(446);
		        	$this->statement();
		        	$this->setState(451);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forStmt(): Context\ForStmtContext
		{
		    $localContext = new Context\ForStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 88, self::RULE_forStmt);

		    try {
		        $this->setState(462);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 42, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(452);
		        	    $this->match(self::FOR);
		        	    $this->setState(453);
		        	    $this->forClause();
		        	    $this->setState(454);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(456);
		        	    $this->match(self::FOR);
		        	    $this->setState(457);
		        	    $this->expression();
		        	    $this->setState(458);
		        	    $this->block();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(460);
		        	    $this->match(self::FOR);
		        	    $this->setState(461);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forClause(): Context\ForClauseContext
		{
		    $localContext = new Context\ForClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 90, self::RULE_forClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(464);
		        $this->simpleStmt();
		        $this->setState(465);
		        $this->match(self::SEMICOLON);
		        $this->setState(466);
		        $this->expression();
		        $this->setState(467);
		        $this->match(self::SEMICOLON);
		        $this->setState(468);
		        $this->simpleStmt();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function simpleStmt(): Context\SimpleStmtContext
		{
		    $localContext = new Context\SimpleStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 92, self::RULE_simpleStmt);

		    try {
		        $this->setState(473);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 43, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(470);
		        	    $this->shortVarDeclNoSemi();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(471);
		        	    $this->assignmentNoSemi();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(472);
		        	    $this->incDecStmt();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function incDecStmt(): Context\IncDecStmtContext
		{
		    $localContext = new Context\IncDecStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 94, self::RULE_incDecStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(475);
		        $this->match(self::IDENTIFIER);
		        $this->setState(476);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::INC || $_la === self::DEC)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function shortVarDeclNoSemi(): Context\ShortVarDeclNoSemiContext
		{
		    $localContext = new Context\ShortVarDeclNoSemiContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 96, self::RULE_shortVarDeclNoSemi);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(478);
		        $this->idList();
		        $this->setState(479);
		        $this->match(self::SHORT_ASSIGN);
		        $this->setState(480);
		        $this->expList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignmentNoSemi(): Context\AssignmentNoSemiContext
		{
		    $localContext = new Context\AssignmentNoSemiContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 98, self::RULE_assignmentNoSemi);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(482);
		        $this->assignTarget();
		        $this->setState(483);
		        $this->assignOp();
		        $this->setState(484);
		        $this->expList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function breakStmt(): Context\BreakStmtContext
		{
		    $localContext = new Context\BreakStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 100, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(486);
		        $this->match(self::BREAK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function continueStmt(): Context\ContinueStmtContext
		{
		    $localContext = new Context\ContinueStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 102, self::RULE_continueStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(488);
		        $this->match(self::CONTINUE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnStmt(): Context\ReturnStmtContext
		{
		    $localContext = new Context\ReturnStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 104, self::RULE_returnStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(490);
		        $this->match(self::RETURN);
		        $this->setState(492);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 44, $this->ctx)) {
		            case 1:
		        	    $this->setState(491);
		        	    $this->expList();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}
	}
}

namespace generated_arm\Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use generated_arm\GolampiArmParser;
	use generated_arm\GolampiArmVisitor;
	use generated_arm\GolampiArmListener;

	class ProgramContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_program;
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::EOF, 0);
	    }

	    /**
	     * @return array<FunctionDeclContext>|FunctionDeclContext|null
	     */
	    public function functionDecl(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(FunctionDeclContext::class);
	    	}

	        return $this->getTypedRuleContext(FunctionDeclContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterProgram($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitProgram($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitProgram($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctionDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_functionDecl;
	    }

	    public function FUNC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::FUNC, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IDENTIFIER, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RPAREN, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function params(): ?ParamsContext
	    {
	    	return $this->getTypedRuleContext(ParamsContext::class, 0);
	    }

	    public function returnTypes(): ?ReturnTypesContext
	    {
	    	return $this->getTypedRuleContext(ReturnTypesContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterFunctionDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitFunctionDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitFunctionDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParamsContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_params;
	    }

	    /**
	     * @return array<ParamContext>|ParamContext|null
	     */
	    public function param(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ParamContext::class);
	    	}

	        return $this->getTypedRuleContext(ParamContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::COMMA);
	    	}

	        return $this->getToken(GolampiArmParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterParams($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitParams($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitParams($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParamContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_param;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IDENTIFIER, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterParam($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitParam($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitParam($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnTypesContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_returnTypes;
	    }

	    /**
	     * @return array<TypeContext>|TypeContext|null
	     */
	    public function type(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TypeContext::class);
	    	}

	        return $this->getTypedRuleContext(TypeContext::class, $index);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RPAREN, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::COMMA);
	    	}

	        return $this->getToken(GolampiArmParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterReturnTypes($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitReturnTypes($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitReturnTypes($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_block;
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RBRACE, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterBlock($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitBlock($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_statement;
	    }

	    public function statementCore(): ?StatementCoreContext
	    {
	    	return $this->getTypedRuleContext(StatementCoreContext::class, 0);
	    }

	    public function SEMICOLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::SEMICOLON, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterStatement($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitStatement($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatementCoreContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_statementCore;
	    }

	    public function functionCall(): ?FunctionCallContext
	    {
	    	return $this->getTypedRuleContext(FunctionCallContext::class, 0);
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

	    public function shortVarDecl(): ?ShortVarDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclContext::class, 0);
	    }

	    public function assignment(): ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function incDecStmt(): ?IncDecStmtContext
	    {
	    	return $this->getTypedRuleContext(IncDecStmtContext::class, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

	    public function switchStmt(): ?SwitchStmtContext
	    {
	    	return $this->getTypedRuleContext(SwitchStmtContext::class, 0);
	    }

	    public function forStmt(): ?ForStmtContext
	    {
	    	return $this->getTypedRuleContext(ForStmtContext::class, 0);
	    }

	    public function breakStmt(): ?BreakStmtContext
	    {
	    	return $this->getTypedRuleContext(BreakStmtContext::class, 0);
	    }

	    public function continueStmt(): ?ContinueStmtContext
	    {
	    	return $this->getTypedRuleContext(ContinueStmtContext::class, 0);
	    }

	    public function returnStmt(): ?ReturnStmtContext
	    {
	    	return $this->getTypedRuleContext(ReturnStmtContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterStatementCore($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitStatementCore($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitStatementCore($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_varDecl;
	    }

	    public function VAR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::VAR, 0);
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::ASSIGN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IDENTIFIER, 0);
	    }

	    public function arrayType(): ?ArrayTypeContext
	    {
	    	return $this->getTypedRuleContext(ArrayTypeContext::class, 0);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterVarDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitVarDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ConstDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_constDecl;
	    }

	    public function CONST(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::CONST, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IDENTIFIER, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::ASSIGN, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterConstDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitConstDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitConstDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ShortVarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_shortVarDecl;
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function SHORT_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::SHORT_ASSIGN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterShortVarDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitShortVarDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitShortVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignmentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_assignment;
	    }

	    public function assignTarget(): ?AssignTargetContext
	    {
	    	return $this->getTypedRuleContext(AssignTargetContext::class, 0);
	    }

	    public function assignOp(): ?AssignOpContext
	    {
	    	return $this->getTypedRuleContext(AssignOpContext::class, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterAssignment($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitAssignment($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignTargetContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_assignTarget;
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function arrayAccess(): ?ArrayAccessContext
	    {
	    	return $this->getTypedRuleContext(ArrayAccessContext::class, 0);
	    }

	    public function pointerAccess(): ?PointerAccessContext
	    {
	    	return $this->getTypedRuleContext(PointerAccessContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterAssignTarget($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitAssignTarget($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitAssignTarget($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_assignOp;
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::ASSIGN, 0);
	    }

	    public function PLUS_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::PLUS_ASSIGN, 0);
	    }

	    public function MINUS_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::MINUS_ASSIGN, 0);
	    }

	    public function MULT_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::MULT_ASSIGN, 0);
	    }

	    public function DIV_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::DIV_ASSIGN, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterAssignOp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitAssignOp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitAssignOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IdListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_idList;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IDENTIFIER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::IDENTIFIER);
	    	}

	        return $this->getToken(GolampiArmParser::IDENTIFIER, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::COMMA);
	    	}

	        return $this->getToken(GolampiArmParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterIdList($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitIdList($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitIdList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_expList;
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::COMMA);
	    	}

	        return $this->getToken(GolampiArmParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterExpList($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitExpList($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitExpList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_type;
	    }

	    public function baseType(): ?BaseTypeContext
	    {
	    	return $this->getTypedRuleContext(BaseTypeContext::class, 0);
	    }

	    public function arrayType(): ?ArrayTypeContext
	    {
	    	return $this->getTypedRuleContext(ArrayTypeContext::class, 0);
	    }

	    public function pointerType(): ?PointerTypeContext
	    {
	    	return $this->getTypedRuleContext(PointerTypeContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterType($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitType($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BaseTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_baseType;
	    }

	    public function INT_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::INT_TYPE, 0);
	    }

	    public function FLOAT_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::FLOAT_TYPE, 0);
	    }

	    public function BOOL_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::BOOL_TYPE, 0);
	    }

	    public function STRING_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::STRING_TYPE, 0);
	    }

	    public function RUNE_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RUNE_TYPE, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterBaseType($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitBaseType($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitBaseType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PointerTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_pointerType;
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::MULT, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterPointerType($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitPointerType($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitPointerType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_arrayType;
	    }

	    public function baseType(): ?BaseTypeContext
	    {
	    	return $this->getTypedRuleContext(BaseTypeContext::class, 0);
	    }

	    /**
	     * @return array<ArrayDimensionContext>|ArrayDimensionContext|null
	     */
	    public function arrayDimension(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ArrayDimensionContext::class);
	    	}

	        return $this->getTypedRuleContext(ArrayDimensionContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterArrayType($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitArrayType($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitArrayType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayDimensionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_arrayDimension;
	    }

	    public function LBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LBRACK, 0);
	    }

	    public function INT_LITERAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::INT_LITERAL, 0);
	    }

	    public function RBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RBRACK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterArrayDimension($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitArrayDimension($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitArrayDimension($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayLiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_arrayLiteral;
	    }

	    public function arrayType(): ?ArrayTypeContext
	    {
	    	return $this->getTypedRuleContext(ArrayTypeContext::class, 0);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RBRACE, 0);
	    }

	    public function arrayElements(): ?ArrayElementsContext
	    {
	    	return $this->getTypedRuleContext(ArrayElementsContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterArrayLiteral($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitArrayLiteral($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitArrayLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayElementsContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_arrayElements;
	    }

	    /**
	     * @return array<ArrayElementContext>|ArrayElementContext|null
	     */
	    public function arrayElement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ArrayElementContext::class);
	    	}

	        return $this->getTypedRuleContext(ArrayElementContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::COMMA);
	    	}

	        return $this->getToken(GolampiArmParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterArrayElements($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitArrayElements($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitArrayElements($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayElementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_arrayElement;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RBRACE, 0);
	    }

	    public function arrayElements(): ?ArrayElementsContext
	    {
	    	return $this->getTypedRuleContext(ArrayElementsContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterArrayElement($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitArrayElement($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitArrayElement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayAccessContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_arrayAccess;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IDENTIFIER, 0);
	    }

	    /**
	     * @return array<ArrayIndexContext>|ArrayIndexContext|null
	     */
	    public function arrayIndex(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ArrayIndexContext::class);
	    	}

	        return $this->getTypedRuleContext(ArrayIndexContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterArrayAccess($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitArrayAccess($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitArrayAccess($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayIndexContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_arrayIndex;
	    }

	    public function LBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LBRACK, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function RBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RBRACK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterArrayIndex($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitArrayIndex($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitArrayIndex($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PointerAccessContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_pointerAccess;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IDENTIFIER, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MULT(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::MULT);
	    	}

	        return $this->getToken(GolampiArmParser::MULT, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterPointerAccess($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitPointerAccess($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitPointerAccess($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctionCallContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_functionCall;
	    }

	    public function functionName(): ?FunctionNameContext
	    {
	    	return $this->getTypedRuleContext(FunctionNameContext::class, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RPAREN, 0);
	    }

	    public function args(): ?ArgsContext
	    {
	    	return $this->getTypedRuleContext(ArgsContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterFunctionCall($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitFunctionCall($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitFunctionCall($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctionNameContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_functionName;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IDENTIFIER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::IDENTIFIER);
	    	}

	        return $this->getToken(GolampiArmParser::IDENTIFIER, $index);
	    }

	    public function DOT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::DOT, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterFunctionName($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitFunctionName($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitFunctionName($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArgsContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_args;
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterArgs($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitArgs($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitArgs($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class RangeExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_rangeExp;
	    }

	    public function LBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LBRACK, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function RANGE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RANGE, 0);
	    }

	    public function RBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RBRACK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterRangeExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitRangeExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitRangeExp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_expression;
	    }

	    public function logicalOrExp(): ?LogicalOrExpContext
	    {
	    	return $this->getTypedRuleContext(LogicalOrExpContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterExpression($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitExpression($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitExpression($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LogicalOrExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_logicalOrExp;
	    }

	    /**
	     * @return array<LogicalAndExpContext>|LogicalAndExpContext|null
	     */
	    public function logicalAndExp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(LogicalAndExpContext::class);
	    	}

	        return $this->getTypedRuleContext(LogicalAndExpContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function OR(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::OR);
	    	}

	        return $this->getToken(GolampiArmParser::OR, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterLogicalOrExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitLogicalOrExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitLogicalOrExp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LogicalAndExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_logicalAndExp;
	    }

	    /**
	     * @return array<EqualityExpContext>|EqualityExpContext|null
	     */
	    public function equalityExp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(EqualityExpContext::class);
	    	}

	        return $this->getTypedRuleContext(EqualityExpContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function AND(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::AND);
	    	}

	        return $this->getToken(GolampiArmParser::AND, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterLogicalAndExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitLogicalAndExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitLogicalAndExp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class EqualityExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_equalityExp;
	    }

	    /**
	     * @return array<RelationalExpContext>|RelationalExpContext|null
	     */
	    public function relationalExp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(RelationalExpContext::class);
	    	}

	        return $this->getTypedRuleContext(RelationalExpContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function EQUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::EQUAL);
	    	}

	        return $this->getToken(GolampiArmParser::EQUAL, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function NOT_EQUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::NOT_EQUAL);
	    	}

	        return $this->getToken(GolampiArmParser::NOT_EQUAL, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterEqualityExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitEqualityExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitEqualityExp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class RelationalExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_relationalExp;
	    }

	    /**
	     * @return array<AdditiveExpContext>|AdditiveExpContext|null
	     */
	    public function additiveExp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(AdditiveExpContext::class);
	    	}

	        return $this->getTypedRuleContext(AdditiveExpContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function LESS(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::LESS);
	    	}

	        return $this->getToken(GolampiArmParser::LESS, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function LESS_EQUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::LESS_EQUAL);
	    	}

	        return $this->getToken(GolampiArmParser::LESS_EQUAL, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function GREATER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::GREATER);
	    	}

	        return $this->getToken(GolampiArmParser::GREATER, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function GREATER_EQUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::GREATER_EQUAL);
	    	}

	        return $this->getToken(GolampiArmParser::GREATER_EQUAL, $index);
	    }

	    public function IN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IN, 0);
	    }

	    public function rangeExp(): ?RangeExpContext
	    {
	    	return $this->getTypedRuleContext(RangeExpContext::class, 0);
	    }

	    public function NOT_KW(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::NOT_KW, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterRelationalExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitRelationalExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitRelationalExp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AdditiveExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_additiveExp;
	    }

	    /**
	     * @return array<MultiplicativeExpContext>|MultiplicativeExpContext|null
	     */
	    public function multiplicativeExp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(MultiplicativeExpContext::class);
	    	}

	        return $this->getTypedRuleContext(MultiplicativeExpContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function PLUS(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::PLUS);
	    	}

	        return $this->getToken(GolampiArmParser::PLUS, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MINUS(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::MINUS);
	    	}

	        return $this->getToken(GolampiArmParser::MINUS, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterAdditiveExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitAdditiveExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitAdditiveExp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class MultiplicativeExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_multiplicativeExp;
	    }

	    /**
	     * @return array<UnaryExpContext>|UnaryExpContext|null
	     */
	    public function unaryExp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(UnaryExpContext::class);
	    	}

	        return $this->getTypedRuleContext(UnaryExpContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MULT(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::MULT);
	    	}

	        return $this->getToken(GolampiArmParser::MULT, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function DIV(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::DIV);
	    	}

	        return $this->getToken(GolampiArmParser::DIV, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MOD(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::MOD);
	    	}

	        return $this->getToken(GolampiArmParser::MOD, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterMultiplicativeExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitMultiplicativeExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitMultiplicativeExp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class UnaryExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_unaryExp;
	    }

	    public function BANG(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::BANG, 0);
	    }

	    public function unaryExp(): ?UnaryExpContext
	    {
	    	return $this->getTypedRuleContext(UnaryExpContext::class, 0);
	    }

	    public function MINUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::MINUS, 0);
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::MULT, 0);
	    }

	    public function AMP(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::AMP, 0);
	    }

	    public function primary(): ?PrimaryContext
	    {
	    	return $this->getTypedRuleContext(PrimaryContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterUnaryExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitUnaryExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitUnaryExp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PrimaryContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_primary;
	    }

	    public function functionCall(): ?FunctionCallContext
	    {
	    	return $this->getTypedRuleContext(FunctionCallContext::class, 0);
	    }

	    public function arrayAccess(): ?ArrayAccessContext
	    {
	    	return $this->getTypedRuleContext(ArrayAccessContext::class, 0);
	    }

	    public function pointerAccess(): ?PointerAccessContext
	    {
	    	return $this->getTypedRuleContext(PointerAccessContext::class, 0);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

	    public function INT_LITERAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::INT_LITERAL, 0);
	    }

	    public function FLOAT_LITERAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::FLOAT_LITERAL, 0);
	    }

	    public function STRING(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::STRING, 0);
	    }

	    public function RUNE_LITERAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RUNE_LITERAL, 0);
	    }

	    public function TRUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::TRUE, 0);
	    }

	    public function FALSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::FALSE, 0);
	    }

	    public function NIL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::NIL, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IDENTIFIER, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LPAREN, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RPAREN, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterPrimary($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitPrimary($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitPrimary($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IfStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_ifStmt;
	    }

	    public function IF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IF, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

	    public function simpleStmt(): ?SimpleStmtContext
	    {
	    	return $this->getTypedRuleContext(SimpleStmtContext::class, 0);
	    }

	    public function SEMICOLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::SEMICOLON, 0);
	    }

	    public function ELSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::ELSE, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterIfStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitIfStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitIfStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_switchStmt;
	    }

	    public function SWITCH(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::SWITCH, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RBRACE, 0);
	    }

	    /**
	     * @return array<CaseClauseContext>|CaseClauseContext|null
	     */
	    public function caseClause(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(CaseClauseContext::class);
	    	}

	        return $this->getTypedRuleContext(CaseClauseContext::class, $index);
	    }

	    public function defaultClause(): ?DefaultClauseContext
	    {
	    	return $this->getTypedRuleContext(DefaultClauseContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterSwitchStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitSwitchStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitSwitchStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CaseClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_caseClause;
	    }

	    public function CASE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::CASE, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

	    public function COLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::COLON, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterCaseClause($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitCaseClause($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitCaseClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DefaultClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_defaultClause;
	    }

	    public function DEFAULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::DEFAULT, 0);
	    }

	    public function COLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::COLON, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterDefaultClause($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitDefaultClause($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitDefaultClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_forStmt;
	    }

	    public function FOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::FOR, 0);
	    }

	    public function forClause(): ?ForClauseContext
	    {
	    	return $this->getTypedRuleContext(ForClauseContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterForStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitForStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitForStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_forClause;
	    }

	    /**
	     * @return array<SimpleStmtContext>|SimpleStmtContext|null
	     */
	    public function simpleStmt(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(SimpleStmtContext::class);
	    	}

	        return $this->getTypedRuleContext(SimpleStmtContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function SEMICOLON(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiArmParser::SEMICOLON);
	    	}

	        return $this->getToken(GolampiArmParser::SEMICOLON, $index);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterForClause($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitForClause($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitForClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SimpleStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_simpleStmt;
	    }

	    public function shortVarDeclNoSemi(): ?ShortVarDeclNoSemiContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclNoSemiContext::class, 0);
	    }

	    public function assignmentNoSemi(): ?AssignmentNoSemiContext
	    {
	    	return $this->getTypedRuleContext(AssignmentNoSemiContext::class, 0);
	    }

	    public function incDecStmt(): ?IncDecStmtContext
	    {
	    	return $this->getTypedRuleContext(IncDecStmtContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterSimpleStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitSimpleStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitSimpleStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IncDecStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_incDecStmt;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::IDENTIFIER, 0);
	    }

	    public function INC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::INC, 0);
	    }

	    public function DEC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::DEC, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterIncDecStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitIncDecStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitIncDecStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ShortVarDeclNoSemiContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_shortVarDeclNoSemi;
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function SHORT_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::SHORT_ASSIGN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterShortVarDeclNoSemi($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitShortVarDeclNoSemi($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitShortVarDeclNoSemi($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignmentNoSemiContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_assignmentNoSemi;
	    }

	    public function assignTarget(): ?AssignTargetContext
	    {
	    	return $this->getTypedRuleContext(AssignTargetContext::class, 0);
	    }

	    public function assignOp(): ?AssignOpContext
	    {
	    	return $this->getTypedRuleContext(AssignOpContext::class, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterAssignmentNoSemi($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitAssignmentNoSemi($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitAssignmentNoSemi($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BreakStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_breakStmt;
	    }

	    public function BREAK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::BREAK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterBreakStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitBreakStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitBreakStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ContinueStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_continueStmt;
	    }

	    public function CONTINUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::CONTINUE, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterContinueStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitContinueStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitContinueStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiArmParser::RULE_returnStmt;
	    }

	    public function RETURN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiArmParser::RETURN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->enterReturnStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiArmListener) {
			    $listener->exitReturnStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiArmVisitor) {
			    return $visitor->visitReturnStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}