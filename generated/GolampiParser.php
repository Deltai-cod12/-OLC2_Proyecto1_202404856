<?php

/*
 * Generated from Golampi.g4 by ANTLR 4.13.2
 */

namespace generated {
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

	final class GolampiParser extends Parser
	{
		public const FUNC = 1, VAR = 2, CONST = 3, NIL = 4, IF = 5, ELSE = 6, 
               SWITCH = 7, CASE = 8, DEFAULT = 9, FOR = 10, BREAK = 11, 
               CONTINUE = 12, RETURN = 13, INT_TYPE = 14, FLOAT_TYPE = 15, 
               BOOL_TYPE = 16, STRING_TYPE = 17, TRUE = 18, FALSE = 19, 
               LPAREN = 20, RPAREN = 21, LBRACE = 22, RBRACE = 23, LBRACK = 24, 
               RBRACK = 25, SEMICOLON = 26, COMMA = 27, COLON = 28, DOT = 29, 
               EQUAL = 30, NOT_EQUAL = 31, LESS_EQUAL = 32, GREATER_EQUAL = 33, 
               LESS = 34, GREATER = 35, ASSIGN = 36, SHORT_ASSIGN = 37, 
               PLUS_ASSIGN = 38, MINUS_ASSIGN = 39, MULT_ASSIGN = 40, DIV_ASSIGN = 41, 
               INC = 42, DEC = 43, AND = 44, OR = 45, NOT = 46, PLUS = 47, 
               MINUS = 48, MULT = 49, DIV = 50, MOD = 51, AMP = 52, STRING = 53, 
               FLOAT_LITERAL = 54, INT_LITERAL = 55, IDENTIFIER = 56, LINE_COMMENT = 57, 
               BLOCK_COMMENT = 58, WS = 59;

		public const RULE_program = 0, RULE_functionDecl = 1, RULE_params = 2, 
               RULE_param = 3, RULE_returnTypes = 4, RULE_block = 5, RULE_statement = 6, 
               RULE_statementCore = 7, RULE_varDecl = 8, RULE_constDecl = 9, 
               RULE_shortVarDecl = 10, RULE_assignment = 11, RULE_assignTarget = 12, 
               RULE_assignOp = 13, RULE_idList = 14, RULE_expList = 15, 
               RULE_type = 16, RULE_baseType = 17, RULE_pointerType = 18, 
               RULE_arrayType = 19, RULE_arrayDimension = 20, RULE_arrayLiteral = 21, 
               RULE_arrayElements = 22, RULE_arrayElement = 23, RULE_arrayAccess = 24, 
               RULE_arrayIndex = 25, RULE_pointerAccess = 26, RULE_functionCall = 27, 
               RULE_functionName = 28, RULE_args = 29, RULE_expression = 30, 
               RULE_logicalOrExp = 31, RULE_logicalAndExp = 32, RULE_equalityExp = 33, 
               RULE_relationalExp = 34, RULE_additiveExp = 35, RULE_multiplicativeExp = 36, 
               RULE_unaryExp = 37, RULE_primary = 38, RULE_ifStmt = 39, 
               RULE_switchStmt = 40, RULE_caseClause = 41, RULE_defaultClause = 42, 
               RULE_forStmt = 43, RULE_forClause = 44, RULE_simpleStmt = 45, 
               RULE_incDecStmt = 46, RULE_shortVarDeclNoSemi = 47, RULE_assignmentNoSemi = 48, 
               RULE_breakStmt = 49, RULE_continueStmt = 50, RULE_returnStmt = 51;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'program', 'functionDecl', 'params', 'param', 'returnTypes', 'block', 
			'statement', 'statementCore', 'varDecl', 'constDecl', 'shortVarDecl', 
			'assignment', 'assignTarget', 'assignOp', 'idList', 'expList', 'type', 
			'baseType', 'pointerType', 'arrayType', 'arrayDimension', 'arrayLiteral', 
			'arrayElements', 'arrayElement', 'arrayAccess', 'arrayIndex', 'pointerAccess', 
			'functionCall', 'functionName', 'args', 'expression', 'logicalOrExp', 
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
		    "'int'", "'float'", "'bool'", "'string'", "'true'", "'false'", "'('", 
		    "')'", "'{'", "'}'", "'['", "']'", "';'", "','", "':'", "'.'", "'=='", 
		    "'!='", "'<='", "'>='", "'<'", "'>'", "'='", "':='", "'+='", "'-='", 
		    "'*='", "'/='", "'++'", "'--'", "'&&'", "'||'", "'!'", "'+'", "'-'", 
		    "'*'", "'/'", "'%'", "'&'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, "FUNC", "VAR", "CONST", "NIL", "IF", "ELSE", "SWITCH", "CASE", 
		    "DEFAULT", "FOR", "BREAK", "CONTINUE", "RETURN", "INT_TYPE", "FLOAT_TYPE", 
		    "BOOL_TYPE", "STRING_TYPE", "TRUE", "FALSE", "LPAREN", "RPAREN", "LBRACE", 
		    "RBRACE", "LBRACK", "RBRACK", "SEMICOLON", "COMMA", "COLON", "DOT", 
		    "EQUAL", "NOT_EQUAL", "LESS_EQUAL", "GREATER_EQUAL", "LESS", "GREATER", 
		    "ASSIGN", "SHORT_ASSIGN", "PLUS_ASSIGN", "MINUS_ASSIGN", "MULT_ASSIGN", 
		    "DIV_ASSIGN", "INC", "DEC", "AND", "OR", "NOT", "PLUS", "MINUS", "MULT", 
		    "DIV", "MOD", "AMP", "STRING", "FLOAT_LITERAL", "INT_LITERAL", "IDENTIFIER", 
		    "LINE_COMMENT", "BLOCK_COMMENT", "WS"
		];

		private const SERIALIZED_ATN =
			[4, 1, 59, 474, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    2, 29, 7, 29, 2, 30, 7, 30, 2, 31, 7, 31, 2, 32, 7, 32, 2, 33, 7, 
		    33, 2, 34, 7, 34, 2, 35, 7, 35, 2, 36, 7, 36, 2, 37, 7, 37, 2, 38, 
		    7, 38, 2, 39, 7, 39, 2, 40, 7, 40, 2, 41, 7, 41, 2, 42, 7, 42, 2, 
		    43, 7, 43, 2, 44, 7, 44, 2, 45, 7, 45, 2, 46, 7, 46, 2, 47, 7, 47, 
		    2, 48, 7, 48, 2, 49, 7, 49, 2, 50, 7, 50, 2, 51, 7, 51, 1, 0, 5, 0, 
		    106, 8, 0, 10, 0, 12, 0, 109, 9, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 
		    1, 1, 3, 1, 117, 8, 1, 1, 1, 1, 1, 3, 1, 121, 8, 1, 1, 1, 1, 1, 1, 
		    2, 1, 2, 1, 2, 5, 2, 128, 8, 2, 10, 2, 12, 2, 131, 9, 2, 1, 3, 1, 
		    3, 1, 3, 1, 4, 1, 4, 1, 4, 1, 4, 1, 4, 5, 4, 141, 8, 4, 10, 4, 12, 
		    4, 144, 9, 4, 1, 4, 1, 4, 3, 4, 148, 8, 4, 1, 5, 1, 5, 5, 5, 152, 
		    8, 5, 10, 5, 12, 5, 155, 9, 5, 1, 5, 1, 5, 1, 6, 1, 6, 3, 6, 161, 
		    8, 6, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 
		    1, 7, 1, 7, 1, 7, 3, 7, 176, 8, 7, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 3, 
		    8, 183, 8, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 3, 8, 190, 8, 8, 3, 8, 
		    192, 8, 8, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 10, 1, 10, 1, 10, 
		    1, 10, 1, 11, 1, 11, 1, 11, 1, 11, 1, 12, 1, 12, 1, 12, 3, 12, 211, 
		    8, 12, 1, 13, 1, 13, 1, 14, 1, 14, 1, 14, 5, 14, 218, 8, 14, 10, 14, 
		    12, 14, 221, 9, 14, 1, 15, 1, 15, 1, 15, 5, 15, 226, 8, 15, 10, 15, 
		    12, 15, 229, 9, 15, 1, 16, 1, 16, 1, 16, 3, 16, 234, 8, 16, 1, 17, 
		    1, 17, 1, 18, 1, 18, 1, 18, 1, 19, 4, 19, 242, 8, 19, 11, 19, 12, 
		    19, 243, 1, 19, 1, 19, 1, 20, 1, 20, 1, 20, 1, 20, 1, 21, 1, 21, 1, 
		    21, 3, 21, 255, 8, 21, 1, 21, 1, 21, 1, 22, 1, 22, 1, 22, 5, 22, 262, 
		    8, 22, 10, 22, 12, 22, 265, 9, 22, 1, 22, 3, 22, 268, 8, 22, 1, 23, 
		    1, 23, 1, 23, 3, 23, 273, 8, 23, 1, 23, 3, 23, 276, 8, 23, 1, 24, 
		    1, 24, 4, 24, 280, 8, 24, 11, 24, 12, 24, 281, 1, 25, 1, 25, 1, 25, 
		    1, 25, 1, 26, 4, 26, 289, 8, 26, 11, 26, 12, 26, 290, 1, 26, 1, 26, 
		    1, 27, 1, 27, 1, 27, 3, 27, 298, 8, 27, 1, 27, 1, 27, 1, 28, 1, 28, 
		    1, 28, 3, 28, 305, 8, 28, 1, 29, 1, 29, 1, 30, 1, 30, 1, 31, 1, 31, 
		    1, 31, 5, 31, 314, 8, 31, 10, 31, 12, 31, 317, 9, 31, 1, 32, 1, 32, 
		    1, 32, 5, 32, 322, 8, 32, 10, 32, 12, 32, 325, 9, 32, 1, 33, 1, 33, 
		    1, 33, 5, 33, 330, 8, 33, 10, 33, 12, 33, 333, 9, 33, 1, 34, 1, 34, 
		    1, 34, 5, 34, 338, 8, 34, 10, 34, 12, 34, 341, 9, 34, 1, 35, 1, 35, 
		    1, 35, 5, 35, 346, 8, 35, 10, 35, 12, 35, 349, 9, 35, 1, 36, 1, 36, 
		    1, 36, 5, 36, 354, 8, 36, 10, 36, 12, 36, 357, 9, 36, 1, 37, 1, 37, 
		    1, 37, 1, 37, 1, 37, 1, 37, 1, 37, 1, 37, 1, 37, 3, 37, 368, 8, 37, 
		    1, 38, 1, 38, 1, 38, 1, 38, 1, 38, 1, 38, 1, 38, 1, 38, 1, 38, 1, 
		    38, 1, 38, 1, 38, 1, 38, 1, 38, 3, 38, 384, 8, 38, 1, 39, 1, 39, 1, 
		    39, 1, 39, 3, 39, 390, 8, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 3, 
		    39, 397, 8, 39, 3, 39, 399, 8, 39, 1, 40, 1, 40, 1, 40, 1, 40, 5, 
		    40, 405, 8, 40, 10, 40, 12, 40, 408, 9, 40, 1, 40, 3, 40, 411, 8, 
		    40, 1, 40, 1, 40, 1, 41, 1, 41, 1, 41, 1, 41, 5, 41, 419, 8, 41, 10, 
		    41, 12, 41, 422, 9, 41, 1, 42, 1, 42, 1, 42, 5, 42, 427, 8, 42, 10, 
		    42, 12, 42, 430, 9, 42, 1, 43, 1, 43, 1, 43, 1, 43, 1, 43, 1, 43, 
		    1, 43, 1, 43, 1, 43, 1, 43, 3, 43, 442, 8, 43, 1, 44, 1, 44, 1, 44, 
		    1, 44, 1, 44, 1, 44, 1, 45, 1, 45, 1, 45, 3, 45, 453, 8, 45, 1, 46, 
		    1, 46, 1, 46, 1, 47, 1, 47, 1, 47, 1, 47, 1, 48, 1, 48, 1, 48, 1, 
		    48, 1, 49, 1, 49, 1, 50, 1, 50, 1, 51, 1, 51, 3, 51, 472, 8, 51, 1, 
		    51, 0, 0, 52, 0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 
		    30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50, 52, 54, 56, 58, 60, 62, 
		    64, 66, 68, 70, 72, 74, 76, 78, 80, 82, 84, 86, 88, 90, 92, 94, 96, 
		    98, 100, 102, 0, 7, 2, 0, 36, 36, 38, 41, 1, 0, 14, 17, 1, 0, 30, 
		    31, 1, 0, 32, 35, 1, 0, 47, 48, 1, 0, 49, 51, 1, 0, 42, 43, 492, 0, 
		    107, 1, 0, 0, 0, 2, 112, 1, 0, 0, 0, 4, 124, 1, 0, 0, 0, 6, 132, 1, 
		    0, 0, 0, 8, 147, 1, 0, 0, 0, 10, 149, 1, 0, 0, 0, 12, 158, 1, 0, 0, 
		    0, 14, 175, 1, 0, 0, 0, 16, 191, 1, 0, 0, 0, 18, 193, 1, 0, 0, 0, 
		    20, 199, 1, 0, 0, 0, 22, 203, 1, 0, 0, 0, 24, 210, 1, 0, 0, 0, 26, 
		    212, 1, 0, 0, 0, 28, 214, 1, 0, 0, 0, 30, 222, 1, 0, 0, 0, 32, 233, 
		    1, 0, 0, 0, 34, 235, 1, 0, 0, 0, 36, 237, 1, 0, 0, 0, 38, 241, 1, 
		    0, 0, 0, 40, 247, 1, 0, 0, 0, 42, 251, 1, 0, 0, 0, 44, 258, 1, 0, 
		    0, 0, 46, 275, 1, 0, 0, 0, 48, 277, 1, 0, 0, 0, 50, 283, 1, 0, 0, 
		    0, 52, 288, 1, 0, 0, 0, 54, 294, 1, 0, 0, 0, 56, 301, 1, 0, 0, 0, 
		    58, 306, 1, 0, 0, 0, 60, 308, 1, 0, 0, 0, 62, 310, 1, 0, 0, 0, 64, 
		    318, 1, 0, 0, 0, 66, 326, 1, 0, 0, 0, 68, 334, 1, 0, 0, 0, 70, 342, 
		    1, 0, 0, 0, 72, 350, 1, 0, 0, 0, 74, 367, 1, 0, 0, 0, 76, 383, 1, 
		    0, 0, 0, 78, 385, 1, 0, 0, 0, 80, 400, 1, 0, 0, 0, 82, 414, 1, 0, 
		    0, 0, 84, 423, 1, 0, 0, 0, 86, 441, 1, 0, 0, 0, 88, 443, 1, 0, 0, 
		    0, 90, 452, 1, 0, 0, 0, 92, 454, 1, 0, 0, 0, 94, 457, 1, 0, 0, 0, 
		    96, 461, 1, 0, 0, 0, 98, 465, 1, 0, 0, 0, 100, 467, 1, 0, 0, 0, 102, 
		    469, 1, 0, 0, 0, 104, 106, 3, 2, 1, 0, 105, 104, 1, 0, 0, 0, 106, 
		    109, 1, 0, 0, 0, 107, 105, 1, 0, 0, 0, 107, 108, 1, 0, 0, 0, 108, 
		    110, 1, 0, 0, 0, 109, 107, 1, 0, 0, 0, 110, 111, 5, 0, 0, 1, 111, 
		    1, 1, 0, 0, 0, 112, 113, 5, 1, 0, 0, 113, 114, 5, 56, 0, 0, 114, 116, 
		    5, 20, 0, 0, 115, 117, 3, 4, 2, 0, 116, 115, 1, 0, 0, 0, 116, 117, 
		    1, 0, 0, 0, 117, 118, 1, 0, 0, 0, 118, 120, 5, 21, 0, 0, 119, 121, 
		    3, 8, 4, 0, 120, 119, 1, 0, 0, 0, 120, 121, 1, 0, 0, 0, 121, 122, 
		    1, 0, 0, 0, 122, 123, 3, 10, 5, 0, 123, 3, 1, 0, 0, 0, 124, 129, 3, 
		    6, 3, 0, 125, 126, 5, 27, 0, 0, 126, 128, 3, 6, 3, 0, 127, 125, 1, 
		    0, 0, 0, 128, 131, 1, 0, 0, 0, 129, 127, 1, 0, 0, 0, 129, 130, 1, 
		    0, 0, 0, 130, 5, 1, 0, 0, 0, 131, 129, 1, 0, 0, 0, 132, 133, 5, 56, 
		    0, 0, 133, 134, 3, 32, 16, 0, 134, 7, 1, 0, 0, 0, 135, 148, 3, 32, 
		    16, 0, 136, 137, 5, 20, 0, 0, 137, 142, 3, 32, 16, 0, 138, 139, 5, 
		    27, 0, 0, 139, 141, 3, 32, 16, 0, 140, 138, 1, 0, 0, 0, 141, 144, 
		    1, 0, 0, 0, 142, 140, 1, 0, 0, 0, 142, 143, 1, 0, 0, 0, 143, 145, 
		    1, 0, 0, 0, 144, 142, 1, 0, 0, 0, 145, 146, 5, 21, 0, 0, 146, 148, 
		    1, 0, 0, 0, 147, 135, 1, 0, 0, 0, 147, 136, 1, 0, 0, 0, 148, 9, 1, 
		    0, 0, 0, 149, 153, 5, 22, 0, 0, 150, 152, 3, 12, 6, 0, 151, 150, 1, 
		    0, 0, 0, 152, 155, 1, 0, 0, 0, 153, 151, 1, 0, 0, 0, 153, 154, 1, 
		    0, 0, 0, 154, 156, 1, 0, 0, 0, 155, 153, 1, 0, 0, 0, 156, 157, 5, 
		    23, 0, 0, 157, 11, 1, 0, 0, 0, 158, 160, 3, 14, 7, 0, 159, 161, 5, 
		    26, 0, 0, 160, 159, 1, 0, 0, 0, 160, 161, 1, 0, 0, 0, 161, 13, 1, 
		    0, 0, 0, 162, 176, 3, 54, 27, 0, 163, 176, 3, 16, 8, 0, 164, 176, 
		    3, 18, 9, 0, 165, 176, 3, 20, 10, 0, 166, 176, 3, 22, 11, 0, 167, 
		    176, 3, 92, 46, 0, 168, 176, 3, 78, 39, 0, 169, 176, 3, 80, 40, 0, 
		    170, 176, 3, 86, 43, 0, 171, 176, 3, 98, 49, 0, 172, 176, 3, 100, 
		    50, 0, 173, 176, 3, 102, 51, 0, 174, 176, 3, 60, 30, 0, 175, 162, 
		    1, 0, 0, 0, 175, 163, 1, 0, 0, 0, 175, 164, 1, 0, 0, 0, 175, 165, 
		    1, 0, 0, 0, 175, 166, 1, 0, 0, 0, 175, 167, 1, 0, 0, 0, 175, 168, 
		    1, 0, 0, 0, 175, 169, 1, 0, 0, 0, 175, 170, 1, 0, 0, 0, 175, 171, 
		    1, 0, 0, 0, 175, 172, 1, 0, 0, 0, 175, 173, 1, 0, 0, 0, 175, 174, 
		    1, 0, 0, 0, 176, 15, 1, 0, 0, 0, 177, 178, 5, 2, 0, 0, 178, 179, 3, 
		    28, 14, 0, 179, 182, 3, 32, 16, 0, 180, 181, 5, 36, 0, 0, 181, 183, 
		    3, 30, 15, 0, 182, 180, 1, 0, 0, 0, 182, 183, 1, 0, 0, 0, 183, 192, 
		    1, 0, 0, 0, 184, 185, 5, 2, 0, 0, 185, 186, 5, 56, 0, 0, 186, 189, 
		    3, 38, 19, 0, 187, 188, 5, 36, 0, 0, 188, 190, 3, 42, 21, 0, 189, 
		    187, 1, 0, 0, 0, 189, 190, 1, 0, 0, 0, 190, 192, 1, 0, 0, 0, 191, 
		    177, 1, 0, 0, 0, 191, 184, 1, 0, 0, 0, 192, 17, 1, 0, 0, 0, 193, 194, 
		    5, 3, 0, 0, 194, 195, 5, 56, 0, 0, 195, 196, 3, 32, 16, 0, 196, 197, 
		    5, 36, 0, 0, 197, 198, 3, 60, 30, 0, 198, 19, 1, 0, 0, 0, 199, 200, 
		    3, 28, 14, 0, 200, 201, 5, 37, 0, 0, 201, 202, 3, 30, 15, 0, 202, 
		    21, 1, 0, 0, 0, 203, 204, 3, 24, 12, 0, 204, 205, 3, 26, 13, 0, 205, 
		    206, 3, 30, 15, 0, 206, 23, 1, 0, 0, 0, 207, 211, 3, 28, 14, 0, 208, 
		    211, 3, 48, 24, 0, 209, 211, 3, 52, 26, 0, 210, 207, 1, 0, 0, 0, 210, 
		    208, 1, 0, 0, 0, 210, 209, 1, 0, 0, 0, 211, 25, 1, 0, 0, 0, 212, 213, 
		    7, 0, 0, 0, 213, 27, 1, 0, 0, 0, 214, 219, 5, 56, 0, 0, 215, 216, 
		    5, 27, 0, 0, 216, 218, 5, 56, 0, 0, 217, 215, 1, 0, 0, 0, 218, 221, 
		    1, 0, 0, 0, 219, 217, 1, 0, 0, 0, 219, 220, 1, 0, 0, 0, 220, 29, 1, 
		    0, 0, 0, 221, 219, 1, 0, 0, 0, 222, 227, 3, 60, 30, 0, 223, 224, 5, 
		    27, 0, 0, 224, 226, 3, 60, 30, 0, 225, 223, 1, 0, 0, 0, 226, 229, 
		    1, 0, 0, 0, 227, 225, 1, 0, 0, 0, 227, 228, 1, 0, 0, 0, 228, 31, 1, 
		    0, 0, 0, 229, 227, 1, 0, 0, 0, 230, 234, 3, 34, 17, 0, 231, 234, 3, 
		    38, 19, 0, 232, 234, 3, 36, 18, 0, 233, 230, 1, 0, 0, 0, 233, 231, 
		    1, 0, 0, 0, 233, 232, 1, 0, 0, 0, 234, 33, 1, 0, 0, 0, 235, 236, 7, 
		    1, 0, 0, 236, 35, 1, 0, 0, 0, 237, 238, 5, 49, 0, 0, 238, 239, 3, 
		    32, 16, 0, 239, 37, 1, 0, 0, 0, 240, 242, 3, 40, 20, 0, 241, 240, 
		    1, 0, 0, 0, 242, 243, 1, 0, 0, 0, 243, 241, 1, 0, 0, 0, 243, 244, 
		    1, 0, 0, 0, 244, 245, 1, 0, 0, 0, 245, 246, 3, 34, 17, 0, 246, 39, 
		    1, 0, 0, 0, 247, 248, 5, 24, 0, 0, 248, 249, 5, 55, 0, 0, 249, 250, 
		    5, 25, 0, 0, 250, 41, 1, 0, 0, 0, 251, 252, 3, 38, 19, 0, 252, 254, 
		    5, 22, 0, 0, 253, 255, 3, 44, 22, 0, 254, 253, 1, 0, 0, 0, 254, 255, 
		    1, 0, 0, 0, 255, 256, 1, 0, 0, 0, 256, 257, 5, 23, 0, 0, 257, 43, 
		    1, 0, 0, 0, 258, 263, 3, 46, 23, 0, 259, 260, 5, 27, 0, 0, 260, 262, 
		    3, 46, 23, 0, 261, 259, 1, 0, 0, 0, 262, 265, 1, 0, 0, 0, 263, 261, 
		    1, 0, 0, 0, 263, 264, 1, 0, 0, 0, 264, 267, 1, 0, 0, 0, 265, 263, 
		    1, 0, 0, 0, 266, 268, 5, 27, 0, 0, 267, 266, 1, 0, 0, 0, 267, 268, 
		    1, 0, 0, 0, 268, 45, 1, 0, 0, 0, 269, 276, 3, 60, 30, 0, 270, 272, 
		    5, 22, 0, 0, 271, 273, 3, 44, 22, 0, 272, 271, 1, 0, 0, 0, 272, 273, 
		    1, 0, 0, 0, 273, 274, 1, 0, 0, 0, 274, 276, 5, 23, 0, 0, 275, 269, 
		    1, 0, 0, 0, 275, 270, 1, 0, 0, 0, 276, 47, 1, 0, 0, 0, 277, 279, 5, 
		    56, 0, 0, 278, 280, 3, 50, 25, 0, 279, 278, 1, 0, 0, 0, 280, 281, 
		    1, 0, 0, 0, 281, 279, 1, 0, 0, 0, 281, 282, 1, 0, 0, 0, 282, 49, 1, 
		    0, 0, 0, 283, 284, 5, 24, 0, 0, 284, 285, 3, 60, 30, 0, 285, 286, 
		    5, 25, 0, 0, 286, 51, 1, 0, 0, 0, 287, 289, 5, 49, 0, 0, 288, 287, 
		    1, 0, 0, 0, 289, 290, 1, 0, 0, 0, 290, 288, 1, 0, 0, 0, 290, 291, 
		    1, 0, 0, 0, 291, 292, 1, 0, 0, 0, 292, 293, 5, 56, 0, 0, 293, 53, 
		    1, 0, 0, 0, 294, 295, 3, 56, 28, 0, 295, 297, 5, 20, 0, 0, 296, 298, 
		    3, 58, 29, 0, 297, 296, 1, 0, 0, 0, 297, 298, 1, 0, 0, 0, 298, 299, 
		    1, 0, 0, 0, 299, 300, 5, 21, 0, 0, 300, 55, 1, 0, 0, 0, 301, 304, 
		    5, 56, 0, 0, 302, 303, 5, 29, 0, 0, 303, 305, 5, 56, 0, 0, 304, 302, 
		    1, 0, 0, 0, 304, 305, 1, 0, 0, 0, 305, 57, 1, 0, 0, 0, 306, 307, 3, 
		    30, 15, 0, 307, 59, 1, 0, 0, 0, 308, 309, 3, 62, 31, 0, 309, 61, 1, 
		    0, 0, 0, 310, 315, 3, 64, 32, 0, 311, 312, 5, 45, 0, 0, 312, 314, 
		    3, 64, 32, 0, 313, 311, 1, 0, 0, 0, 314, 317, 1, 0, 0, 0, 315, 313, 
		    1, 0, 0, 0, 315, 316, 1, 0, 0, 0, 316, 63, 1, 0, 0, 0, 317, 315, 1, 
		    0, 0, 0, 318, 323, 3, 66, 33, 0, 319, 320, 5, 44, 0, 0, 320, 322, 
		    3, 66, 33, 0, 321, 319, 1, 0, 0, 0, 322, 325, 1, 0, 0, 0, 323, 321, 
		    1, 0, 0, 0, 323, 324, 1, 0, 0, 0, 324, 65, 1, 0, 0, 0, 325, 323, 1, 
		    0, 0, 0, 326, 331, 3, 68, 34, 0, 327, 328, 7, 2, 0, 0, 328, 330, 3, 
		    68, 34, 0, 329, 327, 1, 0, 0, 0, 330, 333, 1, 0, 0, 0, 331, 329, 1, 
		    0, 0, 0, 331, 332, 1, 0, 0, 0, 332, 67, 1, 0, 0, 0, 333, 331, 1, 0, 
		    0, 0, 334, 339, 3, 70, 35, 0, 335, 336, 7, 3, 0, 0, 336, 338, 3, 70, 
		    35, 0, 337, 335, 1, 0, 0, 0, 338, 341, 1, 0, 0, 0, 339, 337, 1, 0, 
		    0, 0, 339, 340, 1, 0, 0, 0, 340, 69, 1, 0, 0, 0, 341, 339, 1, 0, 0, 
		    0, 342, 347, 3, 72, 36, 0, 343, 344, 7, 4, 0, 0, 344, 346, 3, 72, 
		    36, 0, 345, 343, 1, 0, 0, 0, 346, 349, 1, 0, 0, 0, 347, 345, 1, 0, 
		    0, 0, 347, 348, 1, 0, 0, 0, 348, 71, 1, 0, 0, 0, 349, 347, 1, 0, 0, 
		    0, 350, 355, 3, 74, 37, 0, 351, 352, 7, 5, 0, 0, 352, 354, 3, 74, 
		    37, 0, 353, 351, 1, 0, 0, 0, 354, 357, 1, 0, 0, 0, 355, 353, 1, 0, 
		    0, 0, 355, 356, 1, 0, 0, 0, 356, 73, 1, 0, 0, 0, 357, 355, 1, 0, 0, 
		    0, 358, 359, 5, 46, 0, 0, 359, 368, 3, 74, 37, 0, 360, 361, 5, 48, 
		    0, 0, 361, 368, 3, 74, 37, 0, 362, 363, 5, 49, 0, 0, 363, 368, 3, 
		    74, 37, 0, 364, 365, 5, 52, 0, 0, 365, 368, 3, 74, 37, 0, 366, 368, 
		    3, 76, 38, 0, 367, 358, 1, 0, 0, 0, 367, 360, 1, 0, 0, 0, 367, 362, 
		    1, 0, 0, 0, 367, 364, 1, 0, 0, 0, 367, 366, 1, 0, 0, 0, 368, 75, 1, 
		    0, 0, 0, 369, 384, 3, 54, 27, 0, 370, 384, 3, 48, 24, 0, 371, 384, 
		    3, 52, 26, 0, 372, 384, 5, 55, 0, 0, 373, 384, 5, 54, 0, 0, 374, 384, 
		    5, 53, 0, 0, 375, 384, 5, 18, 0, 0, 376, 384, 5, 19, 0, 0, 377, 384, 
		    5, 4, 0, 0, 378, 384, 5, 56, 0, 0, 379, 380, 5, 20, 0, 0, 380, 381, 
		    3, 60, 30, 0, 381, 382, 5, 21, 0, 0, 382, 384, 1, 0, 0, 0, 383, 369, 
		    1, 0, 0, 0, 383, 370, 1, 0, 0, 0, 383, 371, 1, 0, 0, 0, 383, 372, 
		    1, 0, 0, 0, 383, 373, 1, 0, 0, 0, 383, 374, 1, 0, 0, 0, 383, 375, 
		    1, 0, 0, 0, 383, 376, 1, 0, 0, 0, 383, 377, 1, 0, 0, 0, 383, 378, 
		    1, 0, 0, 0, 383, 379, 1, 0, 0, 0, 384, 77, 1, 0, 0, 0, 385, 389, 5, 
		    5, 0, 0, 386, 387, 3, 90, 45, 0, 387, 388, 5, 26, 0, 0, 388, 390, 
		    1, 0, 0, 0, 389, 386, 1, 0, 0, 0, 389, 390, 1, 0, 0, 0, 390, 391, 
		    1, 0, 0, 0, 391, 392, 3, 60, 30, 0, 392, 398, 3, 10, 5, 0, 393, 396, 
		    5, 6, 0, 0, 394, 397, 3, 78, 39, 0, 395, 397, 3, 10, 5, 0, 396, 394, 
		    1, 0, 0, 0, 396, 395, 1, 0, 0, 0, 397, 399, 1, 0, 0, 0, 398, 393, 
		    1, 0, 0, 0, 398, 399, 1, 0, 0, 0, 399, 79, 1, 0, 0, 0, 400, 401, 5, 
		    7, 0, 0, 401, 402, 3, 60, 30, 0, 402, 406, 5, 22, 0, 0, 403, 405, 
		    3, 82, 41, 0, 404, 403, 1, 0, 0, 0, 405, 408, 1, 0, 0, 0, 406, 404, 
		    1, 0, 0, 0, 406, 407, 1, 0, 0, 0, 407, 410, 1, 0, 0, 0, 408, 406, 
		    1, 0, 0, 0, 409, 411, 3, 84, 42, 0, 410, 409, 1, 0, 0, 0, 410, 411, 
		    1, 0, 0, 0, 411, 412, 1, 0, 0, 0, 412, 413, 5, 23, 0, 0, 413, 81, 
		    1, 0, 0, 0, 414, 415, 5, 8, 0, 0, 415, 416, 3, 30, 15, 0, 416, 420, 
		    5, 28, 0, 0, 417, 419, 3, 12, 6, 0, 418, 417, 1, 0, 0, 0, 419, 422, 
		    1, 0, 0, 0, 420, 418, 1, 0, 0, 0, 420, 421, 1, 0, 0, 0, 421, 83, 1, 
		    0, 0, 0, 422, 420, 1, 0, 0, 0, 423, 424, 5, 9, 0, 0, 424, 428, 5, 
		    28, 0, 0, 425, 427, 3, 12, 6, 0, 426, 425, 1, 0, 0, 0, 427, 430, 1, 
		    0, 0, 0, 428, 426, 1, 0, 0, 0, 428, 429, 1, 0, 0, 0, 429, 85, 1, 0, 
		    0, 0, 430, 428, 1, 0, 0, 0, 431, 432, 5, 10, 0, 0, 432, 433, 3, 88, 
		    44, 0, 433, 434, 3, 10, 5, 0, 434, 442, 1, 0, 0, 0, 435, 436, 5, 10, 
		    0, 0, 436, 437, 3, 60, 30, 0, 437, 438, 3, 10, 5, 0, 438, 442, 1, 
		    0, 0, 0, 439, 440, 5, 10, 0, 0, 440, 442, 3, 10, 5, 0, 441, 431, 1, 
		    0, 0, 0, 441, 435, 1, 0, 0, 0, 441, 439, 1, 0, 0, 0, 442, 87, 1, 0, 
		    0, 0, 443, 444, 3, 90, 45, 0, 444, 445, 5, 26, 0, 0, 445, 446, 3, 
		    60, 30, 0, 446, 447, 5, 26, 0, 0, 447, 448, 3, 90, 45, 0, 448, 89, 
		    1, 0, 0, 0, 449, 453, 3, 94, 47, 0, 450, 453, 3, 96, 48, 0, 451, 453, 
		    3, 92, 46, 0, 452, 449, 1, 0, 0, 0, 452, 450, 1, 0, 0, 0, 452, 451, 
		    1, 0, 0, 0, 453, 91, 1, 0, 0, 0, 454, 455, 5, 56, 0, 0, 455, 456, 
		    7, 6, 0, 0, 456, 93, 1, 0, 0, 0, 457, 458, 3, 28, 14, 0, 458, 459, 
		    5, 37, 0, 0, 459, 460, 3, 30, 15, 0, 460, 95, 1, 0, 0, 0, 461, 462, 
		    3, 24, 12, 0, 462, 463, 3, 26, 13, 0, 463, 464, 3, 30, 15, 0, 464, 
		    97, 1, 0, 0, 0, 465, 466, 5, 11, 0, 0, 466, 99, 1, 0, 0, 0, 467, 468, 
		    5, 12, 0, 0, 468, 101, 1, 0, 0, 0, 469, 471, 5, 13, 0, 0, 470, 472, 
		    3, 30, 15, 0, 471, 470, 1, 0, 0, 0, 471, 472, 1, 0, 0, 0, 472, 103, 
		    1, 0, 0, 0, 44, 107, 116, 120, 129, 142, 147, 153, 160, 175, 182, 
		    189, 191, 210, 219, 227, 233, 243, 254, 263, 267, 272, 275, 281, 290, 
		    297, 304, 315, 323, 331, 339, 347, 355, 367, 383, 389, 396, 398, 406, 
		    410, 420, 428, 441, 452, 471];
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
			return "Golampi.g4";
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
		        $this->setState(107);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::FUNC) {
		        	$this->setState(104);
		        	$this->functionDecl();
		        	$this->setState(109);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(110);
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
		        $this->setState(112);
		        $this->match(self::FUNC);
		        $this->setState(113);
		        $this->match(self::IDENTIFIER);
		        $this->setState(114);
		        $this->match(self::LPAREN);
		        $this->setState(116);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::IDENTIFIER) {
		        	$this->setState(115);
		        	$this->params();
		        }
		        $this->setState(118);
		        $this->match(self::RPAREN);
		        $this->setState(120);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 562949971492864) !== 0)) {
		        	$this->setState(119);
		        	$this->returnTypes();
		        }
		        $this->setState(122);
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
		        $this->setState(124);
		        $this->param();
		        $this->setState(129);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(125);
		        	$this->match(self::COMMA);
		        	$this->setState(126);
		        	$this->param();
		        	$this->setState(131);
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
		        $this->setState(132);
		        $this->match(self::IDENTIFIER);
		        $this->setState(133);
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
		        $this->setState(147);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT_TYPE:
		            case self::FLOAT_TYPE:
		            case self::BOOL_TYPE:
		            case self::STRING_TYPE:
		            case self::LBRACK:
		            case self::MULT:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(135);
		            	$this->type();
		            	break;

		            case self::LPAREN:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(136);
		            	$this->match(self::LPAREN);
		            	$this->setState(137);
		            	$this->type();
		            	$this->setState(142);
		            	$this->errorHandler->sync($this);

		            	$_la = $this->input->LA(1);
		            	while ($_la === self::COMMA) {
		            		$this->setState(138);
		            		$this->match(self::COMMA);
		            		$this->setState(139);
		            		$this->type();
		            		$this->setState(144);
		            		$this->errorHandler->sync($this);
		            		$_la = $this->input->LA(1);
		            	}
		            	$this->setState(145);
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
		        $this->setState(149);
		        $this->match(self::LBRACE);
		        $this->setState(153);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 140526382124645564) !== 0)) {
		        	$this->setState(150);
		        	$this->statement();
		        	$this->setState(155);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(156);
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
		        $this->setState(158);
		        $this->statementCore();
		        $this->setState(160);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::SEMICOLON) {
		        	$this->setState(159);
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
		        $this->setState(175);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 8, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(162);
		        	    $this->functionCall();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(163);
		        	    $this->varDecl();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(164);
		        	    $this->constDecl();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(165);
		        	    $this->shortVarDecl();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(166);
		        	    $this->assignment();
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(167);
		        	    $this->incDecStmt();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(168);
		        	    $this->ifStmt();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(169);
		        	    $this->switchStmt();
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(170);
		        	    $this->forStmt();
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(171);
		        	    $this->breakStmt();
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(172);
		        	    $this->continueStmt();
		        	break;

		        	case 12:
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(173);
		        	    $this->returnStmt();
		        	break;

		        	case 13:
		        	    $this->enterOuterAlt($localContext, 13);
		        	    $this->setState(174);
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
		        $this->setState(191);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 11, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(177);
		        	    $this->match(self::VAR);
		        	    $this->setState(178);
		        	    $this->idList();
		        	    $this->setState(179);
		        	    $this->type();
		        	    $this->setState(182);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::ASSIGN) {
		        	    	$this->setState(180);
		        	    	$this->match(self::ASSIGN);
		        	    	$this->setState(181);
		        	    	$this->expList();
		        	    }
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(184);
		        	    $this->match(self::VAR);
		        	    $this->setState(185);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(186);
		        	    $this->arrayType();
		        	    $this->setState(189);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::ASSIGN) {
		        	    	$this->setState(187);
		        	    	$this->match(self::ASSIGN);
		        	    	$this->setState(188);
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
		        $this->setState(193);
		        $this->match(self::CONST);
		        $this->setState(194);
		        $this->match(self::IDENTIFIER);
		        $this->setState(195);
		        $this->type();
		        $this->setState(196);
		        $this->match(self::ASSIGN);
		        $this->setState(197);
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
		        $this->setState(199);
		        $this->idList();
		        $this->setState(200);
		        $this->match(self::SHORT_ASSIGN);
		        $this->setState(201);
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
		        $this->setState(203);
		        $this->assignTarget();
		        $this->setState(204);
		        $this->assignOp();
		        $this->setState(205);
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
		        $this->setState(210);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 12, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(207);
		        	    $this->idList();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(208);
		        	    $this->arrayAccess();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(209);
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
		        $this->setState(212);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4191888080896) !== 0))) {
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
		        $this->setState(214);
		        $this->match(self::IDENTIFIER);
		        $this->setState(219);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(215);
		        	$this->match(self::COMMA);
		        	$this->setState(216);
		        	$this->match(self::IDENTIFIER);
		        	$this->setState(221);
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
		        $this->setState(222);
		        $this->expression();
		        $this->setState(227);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(223);
		        	$this->match(self::COMMA);
		        	$this->setState(224);
		        	$this->expression();
		        	$this->setState(229);
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
		        $this->setState(233);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT_TYPE:
		            case self::FLOAT_TYPE:
		            case self::BOOL_TYPE:
		            case self::STRING_TYPE:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(230);
		            	$this->baseType();
		            	break;

		            case self::LBRACK:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(231);
		            	$this->arrayType();
		            	break;

		            case self::MULT:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(232);
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
		        $this->setState(235);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 245760) !== 0))) {
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
		        $this->setState(237);
		        $this->match(self::MULT);
		        $this->setState(238);
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
		        $this->setState(241); 
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        do {
		        	$this->setState(240);
		        	$this->arrayDimension();
		        	$this->setState(243); 
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        } while ($_la === self::LBRACK);
		        $this->setState(245);
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
		        $this->setState(247);
		        $this->match(self::LBRACK);
		        $this->setState(248);
		        $this->match(self::INT_LITERAL);
		        $this->setState(249);
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
		        $this->setState(251);
		        $this->arrayType();
		        $this->setState(252);
		        $this->match(self::LBRACE);
		        $this->setState(254);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 140526382128824336) !== 0)) {
		        	$this->setState(253);
		        	$this->arrayElements();
		        }
		        $this->setState(256);
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
		        $this->setState(258);
		        $this->arrayElement();
		        $this->setState(263);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 18, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(259);
		        		$this->match(self::COMMA);
		        		$this->setState(260);
		        		$this->arrayElement(); 
		        	}

		        	$this->setState(265);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 18, $this->ctx);
		        }
		        $this->setState(267);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::COMMA) {
		        	$this->setState(266);
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
		        $this->setState(275);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::NIL:
		            case self::TRUE:
		            case self::FALSE:
		            case self::LPAREN:
		            case self::NOT:
		            case self::MINUS:
		            case self::MULT:
		            case self::AMP:
		            case self::STRING:
		            case self::FLOAT_LITERAL:
		            case self::INT_LITERAL:
		            case self::IDENTIFIER:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(269);
		            	$this->expression();
		            	break;

		            case self::LBRACE:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(270);
		            	$this->match(self::LBRACE);
		            	$this->setState(272);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 140526382128824336) !== 0)) {
		            		$this->setState(271);
		            		$this->arrayElements();
		            	}
		            	$this->setState(274);
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
		        $this->setState(277);
		        $this->match(self::IDENTIFIER);
		        $this->setState(279); 
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        do {
		        	$this->setState(278);
		        	$this->arrayIndex();
		        	$this->setState(281); 
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        } while ($_la === self::LBRACK);
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
		        $this->setState(283);
		        $this->match(self::LBRACK);
		        $this->setState(284);
		        $this->expression();
		        $this->setState(285);
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
		        $this->setState(288); 
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        do {
		        	$this->setState(287);
		        	$this->match(self::MULT);
		        	$this->setState(290); 
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        } while ($_la === self::MULT);
		        $this->setState(292);
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
		        $this->setState(294);
		        $this->functionName();
		        $this->setState(295);
		        $this->match(self::LPAREN);
		        $this->setState(297);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 140526382124630032) !== 0)) {
		        	$this->setState(296);
		        	$this->args();
		        }
		        $this->setState(299);
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
		        $this->setState(301);
		        $this->match(self::IDENTIFIER);
		        $this->setState(304);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DOT) {
		        	$this->setState(302);
		        	$this->match(self::DOT);
		        	$this->setState(303);
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
		        $this->setState(306);
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
		public function expression(): Context\ExpressionContext
		{
		    $localContext = new Context\ExpressionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_expression);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(308);
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

		    $this->enterRule($localContext, 62, self::RULE_logicalOrExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(310);
		        $this->logicalAndExp();
		        $this->setState(315);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::OR) {
		        	$this->setState(311);
		        	$this->match(self::OR);
		        	$this->setState(312);
		        	$this->logicalAndExp();
		        	$this->setState(317);
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

		    $this->enterRule($localContext, 64, self::RULE_logicalAndExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(318);
		        $this->equalityExp();
		        $this->setState(323);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::AND) {
		        	$this->setState(319);
		        	$this->match(self::AND);
		        	$this->setState(320);
		        	$this->equalityExp();
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
		public function equalityExp(): Context\EqualityExpContext
		{
		    $localContext = new Context\EqualityExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 66, self::RULE_equalityExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(326);
		        $this->relationalExp();
		        $this->setState(331);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::EQUAL || $_la === self::NOT_EQUAL) {
		        	$this->setState(327);

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
		        	$this->setState(328);
		        	$this->relationalExp();
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
		public function relationalExp(): Context\RelationalExpContext
		{
		    $localContext = new Context\RelationalExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 68, self::RULE_relationalExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(334);
		        $this->additiveExp();
		        $this->setState(339);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 64424509440) !== 0)) {
		        	$this->setState(335);

		        	$_la = $this->input->LA(1);

		        	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 64424509440) !== 0))) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(336);
		        	$this->additiveExp();
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
		public function additiveExp(): Context\AdditiveExpContext
		{
		    $localContext = new Context\AdditiveExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 70, self::RULE_additiveExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(342);
		        $this->multiplicativeExp();
		        $this->setState(347);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 30, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(343);

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
		        		$this->setState(344);
		        		$this->multiplicativeExp(); 
		        	}

		        	$this->setState(349);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 30, $this->ctx);
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

		    $this->enterRule($localContext, 72, self::RULE_multiplicativeExp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(350);
		        $this->unaryExp();
		        $this->setState(355);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 31, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(351);

		        		$_la = $this->input->LA(1);

		        		if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 3940649673949184) !== 0))) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(352);
		        		$this->unaryExp(); 
		        	}

		        	$this->setState(357);
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
		public function unaryExp(): Context\UnaryExpContext
		{
		    $localContext = new Context\UnaryExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 74, self::RULE_unaryExp);

		    try {
		        $this->setState(367);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 32, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(358);
		        	    $this->match(self::NOT);
		        	    $this->setState(359);
		        	    $this->unaryExp();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(360);
		        	    $this->match(self::MINUS);
		        	    $this->setState(361);
		        	    $this->unaryExp();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(362);
		        	    $this->match(self::MULT);
		        	    $this->setState(363);
		        	    $this->unaryExp();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(364);
		        	    $this->match(self::AMP);
		        	    $this->setState(365);
		        	    $this->unaryExp();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(366);
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

		    $this->enterRule($localContext, 76, self::RULE_primary);

		    try {
		        $this->setState(383);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 33, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(369);
		        	    $this->functionCall();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(370);
		        	    $this->arrayAccess();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(371);
		        	    $this->pointerAccess();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(372);
		        	    $this->match(self::INT_LITERAL);
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(373);
		        	    $this->match(self::FLOAT_LITERAL);
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(374);
		        	    $this->match(self::STRING);
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(375);
		        	    $this->match(self::TRUE);
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(376);
		        	    $this->match(self::FALSE);
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(377);
		        	    $this->match(self::NIL);
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(378);
		        	    $this->match(self::IDENTIFIER);
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(379);
		        	    $this->match(self::LPAREN);
		        	    $this->setState(380);
		        	    $this->expression();
		        	    $this->setState(381);
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

		    $this->enterRule($localContext, 78, self::RULE_ifStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(385);
		        $this->match(self::IF);
		        $this->setState(389);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 34, $this->ctx)) {
		            case 1:
		        	    $this->setState(386);
		        	    $this->simpleStmt();
		        	    $this->setState(387);
		        	    $this->match(self::SEMICOLON);
		        	break;
		        }
		        $this->setState(391);
		        $this->expression();
		        $this->setState(392);
		        $this->block();
		        $this->setState(398);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ELSE) {
		        	$this->setState(393);
		        	$this->match(self::ELSE);
		        	$this->setState(396);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::IF:
		        	    	$this->setState(394);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::LBRACE:
		        	    	$this->setState(395);
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

		    $this->enterRule($localContext, 80, self::RULE_switchStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(400);
		        $this->match(self::SWITCH);
		        $this->setState(401);
		        $this->expression();
		        $this->setState(402);
		        $this->match(self::LBRACE);
		        $this->setState(406);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::CASE) {
		        	$this->setState(403);
		        	$this->caseClause();
		        	$this->setState(408);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(410);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DEFAULT) {
		        	$this->setState(409);
		        	$this->defaultClause();
		        }
		        $this->setState(412);
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

		    $this->enterRule($localContext, 82, self::RULE_caseClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(414);
		        $this->match(self::CASE);
		        $this->setState(415);
		        $this->expList();
		        $this->setState(416);
		        $this->match(self::COLON);
		        $this->setState(420);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 140526382124645564) !== 0)) {
		        	$this->setState(417);
		        	$this->statement();
		        	$this->setState(422);
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

		    $this->enterRule($localContext, 84, self::RULE_defaultClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(423);
		        $this->match(self::DEFAULT);
		        $this->setState(424);
		        $this->match(self::COLON);
		        $this->setState(428);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 140526382124645564) !== 0)) {
		        	$this->setState(425);
		        	$this->statement();
		        	$this->setState(430);
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

		    $this->enterRule($localContext, 86, self::RULE_forStmt);

		    try {
		        $this->setState(441);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 41, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(431);
		        	    $this->match(self::FOR);
		        	    $this->setState(432);
		        	    $this->forClause();
		        	    $this->setState(433);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(435);
		        	    $this->match(self::FOR);
		        	    $this->setState(436);
		        	    $this->expression();
		        	    $this->setState(437);
		        	    $this->block();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(439);
		        	    $this->match(self::FOR);
		        	    $this->setState(440);
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

		    $this->enterRule($localContext, 88, self::RULE_forClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(443);
		        $this->simpleStmt();
		        $this->setState(444);
		        $this->match(self::SEMICOLON);
		        $this->setState(445);
		        $this->expression();
		        $this->setState(446);
		        $this->match(self::SEMICOLON);
		        $this->setState(447);
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

		    $this->enterRule($localContext, 90, self::RULE_simpleStmt);

		    try {
		        $this->setState(452);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 42, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(449);
		        	    $this->shortVarDeclNoSemi();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(450);
		        	    $this->assignmentNoSemi();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(451);
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

		    $this->enterRule($localContext, 92, self::RULE_incDecStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(454);
		        $this->match(self::IDENTIFIER);
		        $this->setState(455);

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

		    $this->enterRule($localContext, 94, self::RULE_shortVarDeclNoSemi);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(457);
		        $this->idList();
		        $this->setState(458);
		        $this->match(self::SHORT_ASSIGN);
		        $this->setState(459);
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

		    $this->enterRule($localContext, 96, self::RULE_assignmentNoSemi);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(461);
		        $this->assignTarget();
		        $this->setState(462);
		        $this->assignOp();
		        $this->setState(463);
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

		    $this->enterRule($localContext, 98, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(465);
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

		    $this->enterRule($localContext, 100, self::RULE_continueStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(467);
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

		    $this->enterRule($localContext, 102, self::RULE_returnStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(469);
		        $this->match(self::RETURN);
		        $this->setState(471);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 43, $this->ctx)) {
		            case 1:
		        	    $this->setState(470);
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

namespace generated\Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use generated\GolampiParser;
	use generated\GolampiVisitor;
	use generated\GolampiListener;

	class ProgramContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_program;
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::EOF, 0);
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterProgram($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitProgram($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_functionDecl;
	    }

	    public function FUNC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FUNC, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterFunctionDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitFunctionDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_params;
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
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterParams($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitParams($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_param;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterParam($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitParam($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_returnTypes;
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
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterReturnTypes($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitReturnTypes($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_block;
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterBlock($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitBlock($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_statement;
	    }

	    public function statementCore(): ?StatementCoreContext
	    {
	    	return $this->getTypedRuleContext(StatementCoreContext::class, 0);
	    }

	    public function SEMICOLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMICOLON, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStatement($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStatement($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_statementCore;
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterStatementCore($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStatementCore($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_varDecl;
	    }

	    public function VAR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::VAR, 0);
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
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterVarDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitVarDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_constDecl;
	    }

	    public function CONST(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONST, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterConstDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitConstDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_shortVarDecl;
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function SHORT_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SHORT_ASSIGN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterShortVarDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitShortVarDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_assignment;
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterAssignment($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitAssignment($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_assignTarget;
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterAssignTarget($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitAssignTarget($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_assignOp;
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function PLUS_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PLUS_ASSIGN, 0);
	    }

	    public function MINUS_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUS_ASSIGN, 0);
	    }

	    public function MULT_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT_ASSIGN, 0);
	    }

	    public function DIV_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DIV_ASSIGN, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterAssignOp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitAssignOp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_idList;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IDENTIFIER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::IDENTIFIER);
	    	}

	        return $this->getToken(GolampiParser::IDENTIFIER, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterIdList($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitIdList($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_expList;
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
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExpList($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExpList($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_type;
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterType($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitType($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_baseType;
	    }

	    public function INT_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT_TYPE, 0);
	    }

	    public function FLOAT_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOAT_TYPE, 0);
	    }

	    public function BOOL_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BOOL_TYPE, 0);
	    }

	    public function STRING_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING_TYPE, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterBaseType($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitBaseType($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_pointerType;
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterPointerType($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitPointerType($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_arrayType;
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterArrayType($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArrayType($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_arrayDimension;
	    }

	    public function LBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACK, 0);
	    }

	    public function INT_LITERAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT_LITERAL, 0);
	    }

	    public function RBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterArrayDimension($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArrayDimension($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_arrayLiteral;
	    }

	    public function arrayType(): ?ArrayTypeContext
	    {
	    	return $this->getTypedRuleContext(ArrayTypeContext::class, 0);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
	    }

	    public function arrayElements(): ?ArrayElementsContext
	    {
	    	return $this->getTypedRuleContext(ArrayElementsContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterArrayLiteral($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArrayLiteral($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_arrayElements;
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
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterArrayElements($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArrayElements($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_arrayElement;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
	    }

	    public function arrayElements(): ?ArrayElementsContext
	    {
	    	return $this->getTypedRuleContext(ArrayElementsContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterArrayElement($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArrayElement($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_arrayAccess;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterArrayAccess($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArrayAccess($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_arrayIndex;
	    }

	    public function LBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACK, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function RBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterArrayIndex($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArrayIndex($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_pointerAccess;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MULT(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MULT);
	    	}

	        return $this->getToken(GolampiParser::MULT, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterPointerAccess($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitPointerAccess($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_functionCall;
	    }

	    public function functionName(): ?FunctionNameContext
	    {
	    	return $this->getTypedRuleContext(FunctionNameContext::class, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    public function args(): ?ArgsContext
	    {
	    	return $this->getTypedRuleContext(ArgsContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterFunctionCall($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitFunctionCall($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_functionName;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IDENTIFIER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::IDENTIFIER);
	    	}

	        return $this->getToken(GolampiParser::IDENTIFIER, $index);
	    }

	    public function DOT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DOT, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterFunctionName($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitFunctionName($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_args;
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterArgs($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArgs($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArgs($this);
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
		    return GolampiParser::RULE_expression;
	    }

	    public function logicalOrExp(): ?LogicalOrExpContext
	    {
	    	return $this->getTypedRuleContext(LogicalOrExpContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExpression($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExpression($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_logicalOrExp;
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
	    		return $this->getTokens(GolampiParser::OR);
	    	}

	        return $this->getToken(GolampiParser::OR, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterLogicalOrExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitLogicalOrExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_logicalAndExp;
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
	    		return $this->getTokens(GolampiParser::AND);
	    	}

	        return $this->getToken(GolampiParser::AND, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterLogicalAndExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitLogicalAndExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_equalityExp;
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
	    		return $this->getTokens(GolampiParser::EQUAL);
	    	}

	        return $this->getToken(GolampiParser::EQUAL, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function NOT_EQUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::NOT_EQUAL);
	    	}

	        return $this->getToken(GolampiParser::NOT_EQUAL, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterEqualityExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitEqualityExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_relationalExp;
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
	    		return $this->getTokens(GolampiParser::LESS);
	    	}

	        return $this->getToken(GolampiParser::LESS, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function LESS_EQUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::LESS_EQUAL);
	    	}

	        return $this->getToken(GolampiParser::LESS_EQUAL, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function GREATER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::GREATER);
	    	}

	        return $this->getToken(GolampiParser::GREATER, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function GREATER_EQUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::GREATER_EQUAL);
	    	}

	        return $this->getToken(GolampiParser::GREATER_EQUAL, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterRelationalExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitRelationalExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_additiveExp;
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
	    		return $this->getTokens(GolampiParser::PLUS);
	    	}

	        return $this->getToken(GolampiParser::PLUS, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MINUS(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MINUS);
	    	}

	        return $this->getToken(GolampiParser::MINUS, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterAdditiveExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitAdditiveExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_multiplicativeExp;
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
	    		return $this->getTokens(GolampiParser::MULT);
	    	}

	        return $this->getToken(GolampiParser::MULT, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function DIV(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::DIV);
	    	}

	        return $this->getToken(GolampiParser::DIV, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MOD(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MOD);
	    	}

	        return $this->getToken(GolampiParser::MOD, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterMultiplicativeExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitMultiplicativeExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_unaryExp;
	    }

	    public function NOT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NOT, 0);
	    }

	    public function unaryExp(): ?UnaryExpContext
	    {
	    	return $this->getTypedRuleContext(UnaryExpContext::class, 0);
	    }

	    public function MINUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUS, 0);
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT, 0);
	    }

	    public function AMP(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::AMP, 0);
	    }

	    public function primary(): ?PrimaryContext
	    {
	    	return $this->getTypedRuleContext(PrimaryContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterUnaryExp($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitUnaryExp($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_primary;
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

	    public function INT_LITERAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT_LITERAL, 0);
	    }

	    public function FLOAT_LITERAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOAT_LITERAL, 0);
	    }

	    public function STRING(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING, 0);
	    }

	    public function TRUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::TRUE, 0);
	    }

	    public function FALSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FALSE, 0);
	    }

	    public function NIL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NIL, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterPrimary($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitPrimary($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_ifStmt;
	    }

	    public function IF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IF, 0);
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
	        return $this->getToken(GolampiParser::SEMICOLON, 0);
	    }

	    public function ELSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ELSE, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterIfStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitIfStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_switchStmt;
	    }

	    public function SWITCH(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SWITCH, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterSwitchStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitSwitchStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_caseClause;
	    }

	    public function CASE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CASE, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

	    public function COLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::COLON, 0);
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterCaseClause($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitCaseClause($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_defaultClause;
	    }

	    public function DEFAULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DEFAULT, 0);
	    }

	    public function COLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::COLON, 0);
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterDefaultClause($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitDefaultClause($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_forStmt;
	    }

	    public function FOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FOR, 0);
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterForStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitForStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_forClause;
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
	    		return $this->getTokens(GolampiParser::SEMICOLON);
	    	}

	        return $this->getToken(GolampiParser::SEMICOLON, $index);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterForClause($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitForClause($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_simpleStmt;
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterSimpleStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitSimpleStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_incDecStmt;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    public function INC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INC, 0);
	    }

	    public function DEC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DEC, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterIncDecStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitIncDecStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_shortVarDeclNoSemi;
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function SHORT_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SHORT_ASSIGN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterShortVarDeclNoSemi($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitShortVarDeclNoSemi($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_assignmentNoSemi;
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
			if ($listener instanceof GolampiListener) {
			    $listener->enterAssignmentNoSemi($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitAssignmentNoSemi($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_breakStmt;
	    }

	    public function BREAK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BREAK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterBreakStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitBreakStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_continueStmt;
	    }

	    public function CONTINUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONTINUE, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterContinueStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitContinueStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
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
		    return GolampiParser::RULE_returnStmt;
	    }

	    public function RETURN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RETURN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterReturnStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitReturnStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}